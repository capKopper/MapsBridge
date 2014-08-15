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
 * The StdApiResponse class.
 *
 * This very basic class handles the more simple API data, which usually consists
 * of a status code and a message.
 *
 * For more complex data, you should adapt this class and specify a custom class
 * as the type of the $response variable.
 * The provided base class MapsSystem\Bridge\Data\Api\AbstractData is a good
 * starting point to build an advanced data handler.
 */
class StdApiResponse implements ApiResponseInterface
{

    /**
     * The deserialized response data.
     *
     * @JMS\Expose
     * @JMS\Type("array")
     *
     * @var array
     */
    protected $response;

    /**
     * Get the Api response.
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

}

