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

namespace MapsSystem\Bridge\Profile\Publication;

use MapsSystem\Bridge\Profile\SourceConnector as Connector;

/**
 * This class defines a profile based on a MaPS System® publication, whose data
 * are populated using Web Service.
 *
 * Publication streams never require private server key.
 */
class HttpPublicationProfile extends AbstractPublicationProfile
{

    use Connector\HttpConnector
    {
        getDefaultOptions as commectorDefaultOptions;
    }

    /**
     * The URI for requesting a publication stream.
     */
    const PUBLICATION_STREAM_URI = 'private/ws/mapsWebService.php';

    /**
     * Maximum number of objects for each HTTP request.
     *
     * @var int
     */
    protected $maxObjectsPerRequest;

    /**
     * The template to use in the MaPS System Webservices parameters.
     *
     * @var string
     */
    protected $webTemplate;

    /**
     * Get the maximum number of objects that may be retrieved per HTTP request.
     *
     * @return int The maximum number of objects per request
     */
    public function getMaxObjectsPerRequest()
    {
        return $this->maxObjectsPerRequest;
    }

    /**
     * Set the maximum number of objects that may be retrieved per HTTP request.
     *
     * @return ProfileInterface The profile instance
     */
    public function setMaxObjectsPerRequest($maxObjectsPerRequest)
    {
        $this->maxObjectsPerRequest = $maxObjectsPerRequest;
        return $this;
    }

    /**
     * Get the template used for rendering the source data.
     *
     * @return string The export template
     */
    public function getWebTemplate()
    {
        return $this->webTemplate;
    }

    /**
     * Set the exort template.
     *
     * @param string The export template
     *
     * @return ProfileInterface The profile instance
     */
    public function setWebTemplate($webTemplate)
    {
        $this->webTemplate = $webTemplate;
        return $this;
    }

    /**
     * (@inheritdoc)
     */
    protected function getDefaultOptions()
    {
        $defaults = array(
            'method' => 'POST',
            'format' => $this->getFormat(),
            'type' => 'MapsSystem\\Bridge\\Data\\Publication\\StdObject',
        );

        return $defaults + $this->commectorDefaultOptions();
    }

    /**
     * (@inheritdoc)
     *
     * Force the path since the publication stream always uses the same URI.
     */
    public function getPath()
    {
        return self::PUBLICATION_STREAM_URI;
    }

}
