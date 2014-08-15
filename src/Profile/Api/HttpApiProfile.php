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

namespace MapsSystem\Bridge\Profile\Api;

use MapsSystem\Bridge\Profile\AbstractProfile;
use MapsSystem\Bridge\Profile\Exception\HttpProfileException;
use MapsSystem\Bridge\Profile\SourceConnector as Connector;
use Widop\HttpAdapter\HttpAdapterInterface;

/**
 * This class defines a profile based on a specific MaPS System® API, whose data
 * are retrieved using Web Service.
 *
 * Actually it is the only available Profile class related to MaPS System® API,
 * because by definiton an API is an Http service.
 */
class HttpApiProfile extends AbstractProfile
{

    use Connector\HttpConnector
    {
        buildUrl as connectorBuildUrl;
        getDefaultOptions as commectorDefaultOptions;
        retrieveData as commectorRetrieveData;
    }

    /**
     * The URI for requesting the private server key.
     */
    const SERVER_KEY_URI = 'api/getServerKey';

    /**
     * The Web Services private server key.
     *
     * @var string
     *
     * @todo use this preperty with cache handling.
     */
    protected $serverKey;

    /**
     * (@inheritdoc)
     */
    public function getData(array $options = array())
    {
        // API calls always return JSON.
        $options['format'] = 'JSON';

        return parent::getData($options);
    }

    /**
     * (@inheritdoc)
     */
    protected function getDefaultOptions()
    {
        $defaults = array(
            'method' => 'GET',
            'type' => 'MapsSystem\\Bridge\\Data\\Api\\Response\\StdApiResponse',
        );

        return $defaults + $this->commectorDefaultOptions();
    }

    /**
     * (@inheritdoc)
     *
     * Any call to the API requires a private server key. To improve performances,
     * we try to reuse the last existing server key if any. This implies the
     * necessity of an extra call to the target Web Service when the key has
     * expired.
     *
     * @throws \MapsSystem\Bridge\Profile\Exception\HttpProfileException on failure or misconfiguration
     *
     * @todo when the PHP 5.5 version will be spread enough, we could use a
     * "finallly" block looking for both empty data and existing exception, then
     * throw this last.
     *
     * finally
     * {
     *     if (!isset($data) && isset($e))
     *     {
     *         throw $e;
     *     }
     * }
     */
    public function retrieveData(array $options = array())
    {

        try
        {
            $data = $this->commectorRetrieveData($options);
        }
        catch (HttpProfileException $e)
        {
            // If there is an authentication issue, we try to retrieve a new key,
            // if the previously private server key was taken from cache.
            if ($e->getCode() == HttpProfileException::CODE_HTTP_UNAUTHORIZED)
            {
                if (isset($this->serverKey))
                {
                    $options['requestNewKey'] = TRUE;
                    $data = $this->commectorRetrieveData($options);
                }
            }
        }
        finally
        {
            if (!isset($data) && isset($e))
            {
                throw $e;
            }
        }

        return $data;
    }

    /**
     * (@inheritdoc)
     *
     * The option list should contain a key "action", which defines the action
     * to call through the Web Service.
     *
     * @throws \MapsSystem\Bridge\Profile\Exception\HttpProfileException if the "action" key is missing
     */
    protected function buildUrl(array $options = array())
    {
        if (empty($options['action']))
        {
            throw new HttpProfileException('The required "action" option is missing.', HttpProfileException::CODE_MISSING_PARAMETER);
        }

        $baseUrl = $this->connectorBuildUrl($options);
        return rtrim($baseUrl, '/') . '/' . $options['action'];
    }

    /**
     * (@inheritdoc)
     */
    protected function buildHeader(array $options = array())
    {
        return array(
            'MAPSUSERKEY' => $this->getToken(),
            'MAPSSERVERKEY' => $this->getServerKey($options),
        );
    }

    /**
     * Get the path to the cached server key file.
     */
    protected function getServerKeyFilepath()
    {
        if ($cacheDirectory = $this->getCacheDirectory())
        {
            return rtrim($cacheDirectory, '\\/') . '/server.key';
        }
    }

    /**
     * Get the server private key, that is mandatory for authentication.
     *
     * The cached key is used if available, otherwise a request against MaPS
     * System® authentication service is performed to get the private server key.
     *
     * @param array $options  The Http request option list
     *
     * @throws \MapsSystem\Bridge\Profile\Exception\HttpProfileException on failure
     *
     * @return string The server private key
     *
     * @todo use cache, since the key is cached for 12 hours.
     */
    protected function getServerKey($options) {
        if (isset($this->serverKey) && empty($options['requestNewKey']))
        {
            return $this->serverKey;
        }

        // Generally the server private key is valid for 12 hours, so we try to
        // reuse the last cached one if any.
        // Note that the $filepath assignement comes first, so this variable is
        // available at the very end of this method, for caching the key.
        if (($filepath = $this->getServerKeyFilepath()) && empty($options['requestNewKey']))
        {
            if (file_exists($filepath) && $this->serverKey = file_get_contents($filepath))
            {
                return $this->serverKey;
            }
        }

        $count = 0;

        // Caution: the following regex does not handle username and password,
        // because those parameters are ignored in HttpConnector::buildUrl().
        // For more advanced usage, we could rely on http_build_url() from the
        // PECL HTTP library.
        $ServerKeyUrl = preg_replace('
            /^
            (
                (?:ftp|https?):\/\/                               # Supported schemes
                (?:
                    (?:[a-z0-9\.\-]|%[0-9a-f]{2})+                # Host
                    |
                    (?:\[(?:[0-9a-f]{0,4}:)*(?:[0-9a-f]{0,4})\])
                )
                (?::[0-9]+)?                                      # Port
            )
            (?:[\/|\?].*)                                         # URI and query
            $/xi',
            '$1/' . self::SERVER_KEY_URI,
            $this->connectorBuildUrl($options),
            1,
            $count
        );

        if (!$count)
        {
            throw new HttpProfileException(sprintf('The built URL "%s" is not valid.', $ServerKeyUrl));
        }

        $response = $this->getHttpAdapter()->getContent($ServerKeyUrl, array('MAPSUSERKEY' => $this->getToken()));

        // The HTTP status code that is returned on a successful authentication
        // request.
        // Note that we do not check the 401 status code and do not throw an
        // exception with the HttpProfileException::CODE_HTTP_UNAUTHORIZED code,
        // because on the first run (try block in self::retrieveData) such
        // exception would be catched, redirecting to the current method...
        // But if we are there, we already made an Api call for a server key,
        // which was refused to us... No need to ask twice!
        if ($response->getStatusCode() != 202)
        {
            throw new HttpProfileException(sprintf('Failed to get the server private key with statuc code %s.', $response->getStatusCode()), HttpProfileException::CODE_HTTP_UNSUPPORTED_STATUS);
        }

        $data = json_decode($response->getBody());

        if (empty($data->response))
        {
            throw new HttpProfileException('Failed to decode the server private key or invalid data inside the response.', HttpProfileException::CODE_INVALID_DATA);
        }

        $this->serverKey = $data->response;

        // Store the key in the cache if available.
        if ($filepath)
        {
            file_put_contents($filepath, $data->response);
        }

        return $this->serverKey;
    }

}
