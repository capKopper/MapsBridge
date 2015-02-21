<?php

/**
 * MaPS System® API
 *
 * @package    MaPS System Bridge
 * @subpackage Data
 * @author     Fabien Leroux <fabien.l@capkopper.fr>
 * @license    http://www.gnu.org/licenses/gpl-3.0.en.html
 * @copyright  Copyright (c) 2014, capKopper
 * @link       http://www.maps-system.com/ MaPS System®
 * @link       http://www.capkopper.fr/ capKopper
 */

namespace MapsSystem\Bridge\Data\Api;

use JMS\Serializer\Annotation AS JMS;

/**
 * This interface defines nothing by itself and represents any MaPS System® data.
 *
 * Note that we use an exclusion policy, which avoid advanced child classes to
 * specify an "Exclude" annotation on each non-native properties.
 *
 * This implies that all properties to be (de)serialized have to be exposed.
 *
 * @JMS\ExclusionPolicy("all")
 */
interface DataInterface
{

    /**
     * This status means that the data were created manually, without calling the API.
     *
     * We use a negative number to avoid conflict with MaPS System® statuses.
     */
    const STATUS_CUSTOM = -1;

    /**
     * This status means that an error occurred while requesting the data from the API.
     * This could be a connexion problem, an error inside MaPS System®, or an error while
     * deserializing the data (malformed JSON, wrong JMS annotations, etc.).
     *
     * We use a negative number to avoid conflict with MaPS System® statuses.
     */
    const STATUS_API_ERROR = -2;

    /**
     * Get the response status.
     */
    public function getResponseStatus();

    /**
     * Get the response message.
     */
    public function getResponseMessage();

    /**
     * Whether the data are valid.
     *
     * Child classes should use the API response statuses to define whether the data are
     * valid or not.
     *
     * @return bool TRUE if data are valid.
     */
    public function isValid();

}

