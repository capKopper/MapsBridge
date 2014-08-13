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
 * Profile exception.
 */
class ProfileException extends \Exception
{

    /**
     * Exception code related to a missing parameter or option.
     */
    const CODE_MISSING_PARAMETER = 100;

    /**
     * Exception code related to unexpected data.
     */
    const CODE_INVALID_DATA = 101;

}
