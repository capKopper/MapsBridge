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
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\JsonDeserializationVisitor;

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
     * Class constructor.
     *
     * @param int $status The data status.
     *
     * @return \MapsSystem\Bridge\Data\Api\DataInterface
     */
    public function __construct($status = self::STATUS_CUSTOM)
    {
        $this->responseStatus = $status;
    }

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

    /**
     * (@inheritdoc)
     */
    public function isValid()
    {
        // The API should never return a status of 0, but always positive integers.
        return (int) $this->getResponseStatus() > 0;
    }

    /**
     * Provide a base for a JSON deserialization callback that perform the same mapping
     * using annotations than default JMS class.
     *
     * The purpose of this method is to allow child classes to perform basic mapping as
     * usual, but also perform custom handling of non-exposed properties.
     *
     * @return \MapsSystem\Bridge\Data\Api\DataInterface
     */
    public function deserializeFromJson(JsonDeserializationVisitor $visitor, $data, DeserializationContext $context)
    {
        // Use the standard annotation mechanism.
        $type = array('name' => __CLASS__, 'params' => array());
        $metadata = $context->getMetadataFactory()->getMetadataForClass(__CLASS__);
        $exclusionStrategy = $context->getExclusionStrategy();
        $visitor->startVisitingObject($metadata, $this, $type, $context);

        foreach ($metadata->propertyMetadata as $propertyMetadata) {
            if (null !== $exclusionStrategy && $exclusionStrategy->shouldSkipProperty($propertyMetadata, $context)) {
                continue;
            }

            if ($context instanceof DeserializationContext && $propertyMetadata->readOnly) {
                continue;
            }

            $context->pushPropertyMetadata($propertyMetadata);
            $visitor->visitProperty($propertyMetadata, $data, $context);
            $context->popPropertyMetadata();
        }

        $visitor->endVisitingObject($metadata, $data, $type, $context);
        return $this;
    }

}

