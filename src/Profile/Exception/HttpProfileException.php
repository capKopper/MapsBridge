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

namespace MapsSystem\Bridge\Profile\Exception;

/**
 * Http Profile exception.
 */
class HttpProfileException extends ProfileException
{

    /**
     * Exception code related to an invalid URL.
     */
    const CODE_INVALID_URL = 200;

    /**
     * Exception code related to an HTTP unauthorized access.
     */
    const CODE_HTTP_UNAUTHORIZED = 401;

    /**
     * Exception code related to an unexisting method in a REST service.
     */
    const CODE_HTTP_METHOD_NOT_ALLOWED = 405;

    /**
     * Exception code related to an unsupported status in a HTTP response.
     */
    const CODE_HTTP_UNSUPPORTED_STATUS = 499;

}
