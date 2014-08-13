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

use MapsSystem\Bridge\Profile\AbstractProfile;

/**
 * Definition of the abstract Publication Profile class.
 */
abstract class AbstractPublicationProfile extends AbstractProfile
{

    /**
     * The MaPS System® publication ID.
     *
     * @var int
     */
    protected $publicationId;

    /**
     * ID of the MaPS System® root object.
     *
     * @var int
     */
    protected $rootObjectId;

    /**
     * The response format, which may be either XML or JSON.
     *
     * @var string
     */
    protected $format;

    /**
     * Get the publication ID.
     *
     * @return int The publication ID
     */
    public function getPublicationId()
    {
        return $this->publicationId;
    }

    /**
     * Set the publication ID.
     *
     * @return ProfileInterface The profile instance
     */
    public function setPublicationId($publicationId)
    {
        $this->publicationId = $publicationId;
        return $this;
    }

    /**
     * Get the profile root object ID.
     *
     * @return int The root object ID
     */
    public function getRootObjectId()
    {
        return $this->rootObjectId;
    }

    /**
     * Set the publication root object ID.
     *
     * @param int The root object ID of the publication.
     *
     * @return ProfileInterface The profile instance
     */
    public function setRootObjectId($rootObjectId)
    {
        $this->rootObjectId = $rootObjectId;
        return $this;
    }

    /**
     * Get the response format.
     *
     * @return string Either JSON or XML
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the response format.
     *
     * @return ProfileInterface The profile instance
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

}
