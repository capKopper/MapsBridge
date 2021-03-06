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

namespace MapsSystem\Bridge\Data\Api\Response;

use JMS\Serializer\Annotation AS JMS;

/**
 * This interface defines nothing by itself and represents any MaPS System® data
 * provided by the API.
 *
 * Note that we use an exclusion policy, which avoid advanced child classes to
 * specify an "Exclude" annotation on each non-native properties.
 *
 * This implies that all properties to be (de)serialized have to be exposed.
 *
 * @JMS\ExclusionPolicy("all")
 */
interface ApiResponseInterface
{

    /**
     * Get the Api response.
     *
     * @return mixed The data provided by the API may vary a lot. For complex data handling, you should rely on the base class \MapsSystem\Bridge\Data\Api\AbstractData
     */
    public function getResponse();

}

