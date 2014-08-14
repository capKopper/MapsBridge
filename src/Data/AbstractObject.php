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
 * The base class for any MaPS System® object.
 */
abstract class AbstractObject implements ObjectInterface
{

  /**
   * @JMS\Type("integer")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $id;

  /**
   * @JMS\Type("integer")
   * @SerializedName("idobject_parent")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $parentId;

  /**
   * @JMS\Type("integer")
   * @SerializedName("idobject_origin")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $sourceId;

  /**
   * @JMS\Type("string")
   * @JMS\@Expose
   *
   * @var string
   */
  protected $code;

  /**
   * @JMS\Type("integer")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $nature;

  /**
   * @JMS\Type("integer")
   * @SerializedName("object_type")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $objectType;

  /**
   * @JMS\Type("integer")
   * @SerializedName("seq")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $sequence;

  /**
   * @JMS\Type("integer")
   * @JMS\@Expose
   *
   * @var int
   */
  protected $status;

  /**
   * @JMS\Type("DateTime<'U'>")
   * @SerializedName("lastmodification")
   * @JMS\@Expose
   *
   * @var \DateTime
   */
  protected $updated;

  /**
   * @JMS\Type("array")
   * @JMS\@Expose
   *
   * @var array
   */
  protected $classes;

  /**
   * @JMS\Type("array")
   * @JMS\@Expose
   *
   * @var array
   */
  protected $attributes;

  /**
   * @JMS\Type("array")
   * @SerializedName("medias")
   * @JMS\@Expose
   *
   * @var array
   */
  protected $media;

  /**
   * (@inheritdoc)
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * (@inheritdoc)
   */
  public function setId($id)
  {
      $this->id = $id;
  }

  /**
   * (@inheritdoc)
   */
  public function getParentId()
  {
      return $this->parentId;
  }

  /**
   * (@inheritdoc)
   */
  public function setParentId($id)
  {
      $this->parentId = $id;
  }

  /**
   * (@inheritdoc)
   */
  public function getSourceId()
  {
      return $this->sourceId;
  }

  /**
   * (@inheritdoc)
   */
  public function setSourceId($id)
  {
      $this->sourceId = $id;
  }

  /**
   * (@inheritdoc)
   */
  public function getCode()
  {
      return $this->code;
  }

  /**
   * (@inheritdoc)
   */
  public function setCode($code)
  {
      $this->code = $code;
  }

  /**
   * (@inheritdoc)
   */
  public function getNature()
  {
      return $this->nature;
  }

  /**
   * (@inheritdoc)
   */
  public function setNature($nature)
  {
      $this->nature = $nature;
  }

  /**
   * (@inheritdoc)
   */
  public function getObjectType()
  {
      return $this->objectType;
  }

  /**
   * (@inheritdoc)
   */
  public function setObjectType($type)
  {
      $this->objectType = $type;
  }

  /**
   * (@inheritdoc)
   */
  public function getSequence()
  {
      return $this->sequence;
  }

  /**
   * (@inheritdoc)
   */
  public function setSequence($sequence)
  {
      $this->sequence = $sequence;
  }

  /**
   * (@inheritdoc)
   */
  public function getStatus()
  {
      return $this->status;
  }

  /**
   * (@inheritdoc)
   */
  public function setStatus($status)
  {
      $this->status = $status;
  }

  /**
   * (@inheritdoc)
   */
  public function getUpdated()
  {
      return $this->updated;
  }

  /**
   * (@inheritdoc)
   */
  public function setUpdated(\DateTime $date)
  {
      $this->updated = $date;
  }

  /**
   * (@inheritdoc)
   */
  public function getClasses()
  {
      return $this->classes;
  }

  /**
   * (@inheritdoc)
   */
  public function getAttributes()
  {
      return $this->attributes;
  }

}
