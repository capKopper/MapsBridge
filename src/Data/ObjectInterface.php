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

/**
 * This interface defines the minimum required method for a MaPS System® object.
 */
interface ObjectInterface extends DataInterface
{

  /**
   * Get the object ID.
   *
   * @return int
   */
  public function getId();

  /**
   * Set the object ID.
   *
   * @param int $id The new object ID.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setId($id);

  /**
   * Get the parent object ID.
   *
   * @return int
   */
  public function getParentId();

  /**
   * Set the parent object ID.
   *
   * @param int $id The new parent object ID.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setParentId($id);

  /**
   * Get the source object ID.
   *
   * @return int
   */
  public function getSourceId();

  /**
   * Set the source object ID.
   *
   * @param int $id The new source object ID.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setSourceId($id);

  /**
   * Get the code.
   *
   * @return string
   */
  public function getCode();

  /**
   * Set the code.
   *
   * @param string $code The new object code.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setCode($code);

  /**
   * Get the nature.
   *
   * @return int
   */
  public function getNature();

  /**
   * Set the nature.
   *
   * @param int $nature The new object nature.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setNature($nature);

  /**
   * Get the type.
   *
   * @return int
   */
  public function getObjectType();

  /**
   * Set the type.
   *
   * @param int $type The new object type.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setObjectType($type);

  /**
   * Get the sequence.
   *
   * @return int
   */
  public function getSequence();

  /**
   * Set the sequence.
   *
   * @param int $sequence The new object sequence.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setSequence($sequence);

  /**
   * Get the status.
   *
   * @return int
   */
  public function getStatus();

  /**
   * Set the status.
   *
   * @param int $status The new object status.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setStatus($status);

  /**
   * Get the updated date.
   *
   * @return \DateTime
   */
  public function getUpdated();

  /**
   * Set the updated date.
   *
   * @param \DateTime $date The last modification date.
   *
   * @return \MapsSystem\Bridge\Data\ObjectInterface The current instance
   */
  public function setUpdated(\DateTime $date);

  /**
   * Get the classes.
   *
   * @return array
   */
  public function getClasses();

  /**
   * Get the attributes.
   *
   * @return array
   */
  public function getAttributes();

}
