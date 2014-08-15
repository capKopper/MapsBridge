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
 * Handle API response that is a single text string.
 */
class TextApiResponse implements ApiResponseInterface
{

    /**
     * The deserialized response data.
     *
     * @JMS\Expose
     * @JMS\Type("string")
     *
     * @var string
     */
    protected $response;

    /**
     * Get the Api response.
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

}
