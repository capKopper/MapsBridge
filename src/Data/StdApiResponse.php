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

namespace MapsSystem\Bridge\Data;

use JMS\Serializer\Annotation AS JMS;

/**
 * The StdApiResponse class.
 *
 * @JMS\ExclusionPolicy("all")
 *
 * @todo implement ArrayAccess
 */
class StdApiResponse
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
   */
  public function getResponse()
  {
      return $this->response;
  }

}
