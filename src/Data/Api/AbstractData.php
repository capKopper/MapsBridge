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
 * Base for building any kind of MaPS System® API data.
 */
abstract class AbstractData implements DataInterface
{

    /**
     * @JMS\Type("integer")
     * @JMS\SerializedName("status")
     * @JMS\Expose
     *
     * @var int
     */
    protected $responseStatus;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("message")
     * @JMS\Expose
     *
     * @var int
     */
    protected $responseMessage;

    /**
     * (@inheritdoc)
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     * (@inheritdoc)
     */
    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

}

