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

namespace MapsSystem\Bridge\Profile;

use Doctrine\Common\Annotations\AnnotationRegistry;
use MapsSystem\Bridge\Profile\Exception\ProfileException;
use JMS\Serializer\SerializerBuilder;

/**
 * Definition of the abstract Profile class.
 */
abstract class AbstractProfile implements ProfileInterface
{

    /**
     * The profile title, always treated as non-markup plain text.
     *
     * @var string
     */
    protected $title;

    /**
     * The cache directory. If not specified, data are not cached.
     *
     * @var string
     */
    protected $cacheDirectory;

    /**
     * (@inheritdoc)
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * (@inheritdoc)
     *
     * @return ProfileInterface The profile instance
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * (@inheritdoc)
     *
     * @return ProfileInterface The profile instance
     */
    public function setCacheDirectory($directory)
    {
        $this->cacheDirectory = $directory;
        return $this;
    }

    /**
     * (@inheritdoc)
     */
    public function getCacheDirectory()
    {
        if (isset($this->cacheDirectory) && is_writeable($this->cacheDirectory))
        {
            return $this->cacheDirectory;
        }
    }

    /**
     * Get the default options used for retrieving data.
     *
     * @return array A keyed array of options.
     */
    protected function getDefaultOptions()
    {
        return array();
    }

    /**
     * (@inheritdoc)
     *
     * @throws \MapsSystem\Bridge\Profile\Exception\ProfileException if required options are missing
     */
    public function getData(array $options = array())
    {
        $options += $this->getDefaultOptions();

        if (!isset($options['type']))
        {
            throw new ProfileException('The required "type" option is missing.', ProfileException::CODE_MISSING_PARAMETER);
        }

        $raw = $this->retrieveData($options);
        return $this->parseData($raw, $options);
    }

    /**
     * Retrieve data from MaPS System®.
     *
     * @param array $options A list of options to modify the default bahaviors
     *
     * @return string The raw data
     */
    abstract protected function retrieveData(array $options = array());

    /**
     * Retrieve data from MaPS System®.
     *
     * @param string $raw     The raw data retrieved from MaPS System®
     * @param array  $options A list of options to modify the default bahaviors
     */
    protected function parseData($raw, array $options = array())
    {
        AnnotationRegistry::registerLoader('class_exists');
        $builder = SerializerBuilder::create();

        if ($cacheDirectory = $this->getCacheDirectory())
        {
            $builder->setCacheDir($cacheDirectory);
        }

        $serializer = $builder->build();
        return $serializer->deserialize($raw, $options['type'], strtolower($options['format']));
    }

}
