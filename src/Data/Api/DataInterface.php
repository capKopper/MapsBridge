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
     * Get the response status.
     */
    public function getResponseStatus();

    /**
     * Get the response message.
     */
    public function getResponseMessage();

}

