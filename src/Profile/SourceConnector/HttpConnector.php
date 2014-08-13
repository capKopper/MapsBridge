<?php

/**
 * MaPS System® API
 *
 * @package    MaPS System Bridge
 * @subpackage Profile
 * @author     Fabien Leroux <fabien.l@capkopper.fr>
 * @license    http://www.gnu.org/licenses/gpl-3.0.en.html
 * @copyright  Copyright (c) 2014, capKopper
 * @link       http://www.maps-system.com/ MaPS System®
 * @link       http://www.capkopper.fr/ capKopper
 */

namespace MapsSystem\Bridge\Profile\SourceConnector;

use MapsSystem\Bridge\Profile\Exception\HttpProfileException;
use Widop\HttpAdapter\HttpAdapterInterface;

/**
 * This trait intends to get the MaPS System® data from Http request.
 */
trait HttpConnector
{

    /**
     * The Http adapter, which handles the Http request.
     *
     * @var HttpAdapterInterface
     */
    protected $httpAdapter;

    /**
     * The security token used to authenticate with MaPS System® Web Services.
     *
     * @var string on 40 hexadecimal characters
     */
    protected $token;


    /**
     * The MaPS System® Web Services scheme.
     *
     * @var string
     */
    protected $scheme = 'http';

    /**
     * The MaPS System® Web Services host.
     *
     * @var string
     */
    protected $host;

    /**
     * The MaPS System® Web Services port.
     *
     * @var string
     */
    protected $port;

    /**
     * The MaPS System® Web Services base path.
     *
     * @var string
     */
    protected $path;

    /**
     * Class constructor.
     *
     * @param HttpAdapterInterface $HttpAdapter The class that handles the Http request
     * @param string               $url         The full Web Service URL
     * @param string               $token       The Web Service security token
     *
     * @return \MapsSystem\Bridge\Profile\ProfileInterface
     */
    public function __construct(HttpAdapterInterface $httpAdapter, $url, $token)
    {
        $this->httpAdapter = $httpAdapter;
        $this->token = $token;

        if (!$parts = parse_url($url))
        {
            throw new HttpProfileException('The MaPS Service URL is not valid.', HttpProfileException::CODE_INVALID_URL);
        }

        foreach (array('scheme', 'host', 'port', 'path') as $key)
        {
            if (isset($parts[$key]))
            {
                $this->{$key} = $parts[$key];
            }
        }

        if (!isset($this->host))
        {
            throw new HttpProfileException('The MaPS Service host is missing.', HttpProfileException::CODE_INVALID_URL);
        }
    }

    /**
     * Get the Http Adapter.
     *
     * @return HttpAdapterInterface
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * Get the profile security token.
     *
     * @return string The security token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the profile token.
     *
     * @return ProfileInterface The profile instance
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get the Web Service scheme.
     *
     * @return string The Web Service scheme
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Set the Web Service scheme.
     *
     * @param string The Web Service scheme
     *
     * @return ProfileInterface The profile instance
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Get the host where the Web Service are located.
     *
     * @return string The Web Service host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the Web Service host.
     *
     * @param string The Web Service host
     *
     * @return ProfileInterface The profile instance
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Get the Web Service port.
     *
     * @return string The Web Service port
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set the Web Service port.
     *
     * @param string The Web Service port
     *
     * @return ProfileInterface The profile instance
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * Get the Web Service base path.
     *
     * @return string The Web Service base path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the Web Service base path.
     *
     * @param string The Web Service base path
     *
     * @return ProfileInterface The profile instance
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * (@inheritdoc)
     *
     * @throws \MapsSystem\Bridge\Profile\Exception\HttpProfileException on failure or misconfiguration
     */
    public function retrieveData(array $options = array())
    {
        switch (strtoupper($options['method']))
        {
            case 'GET':
                $url = $this->buildUrl($options);

                if (!empty($options['data']))
                {
                    $url .= '?' . (is_string($options['data']) ? $options['data'] : http_build_query($options['data']));
                }

                $response = $this->getHttpAdapter()->getContent($url, $this->buildHeader($options));
                break;
            case 'POST':
                $response = $this->getHttpAdapter()->postContent($this->buildUrl($options), $this->buildHeader($options), $options['data']);
                break;
            default:
                throw new HttpProfileException(sprintf('The method "%s" is not supported.', $options['method']), HttpProfileException::CODE_MISSING_PARAMETER);
        }

        switch ($response->getStatusCode())
        {
            // The HTTP status code that is returned on a successful request.
            case 200:
                return $response->getBody();

            // The HTTP status code that is returned on an authentication
            // failure.
            case 401:
                throw new HttpProfileException(sprintf('Authentication to the Web Service failed (%s).', print_r($response, TRUE)), HttpProfileException::CODE_HTTP_UNAUTHORIZED);

            // The HTTP status code that is returned for a request against an
            // unexisting service.
            case 405:
                throw new HttpProfileException(sprintf('The called method does not match any known Web Service (%s).', print_r($response, TRUE)), HttpProfileException::CODE_HTTP_METHOD_NOT_ALLOWED);

            // Unsupported HTTP status code.
            default:
                throw new HttpProfileException(sprintf('The Web Service call was unsuccessful, with unsupported status code (%s).', print_r($response, TRUE)), HttpProfileException::CODE_HTTP_UNSUPPORTED_STATUS);
        }
    }

    /**
     * (@inheritdoc)
     */
    protected function getDefaultOptions()
    {
        return array(
            'format' => 'JSON',
            'method' => 'GET',
            'data' => array(),
        );
    }

    /**
     * Build the URL of the Web Service for the current request.
     *
     * @param array $options The Http request option list
     *
     * @return string The full qualified URL
     */
    protected function buildUrl(array $options = array())
    {
        $parts = array(
            'scheme' => $this->getScheme() . '://',
            'host' => $this->getHost(),
        );

        if (NULL !== $port = $this->getPort())
        {
            $parts['port'] = ':' . $port;
        }

        $parts['path'] = '/' . ltrim($this->getPath(), '/');
        return implode('', $parts);
    }

    /**
     * Build the URL of the Web Service for the current request.
     *
     * @param array $options The Http request option list
     *
     * @return array The header to pass to the Http request
     */
    protected function buildHeader(array $options = array())
    {
        return array();
    }

}
