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

/**
 * Definition of the Profile interface.
 */
interface ProfileInterface
{

    /**
     * MaPS System® default language ID.
     */
    const MAPS_SYSTEM_LANGUAGE_DEFAULT_ID = 1;

    /**
     * Get the profile title.
     *
     * @return string The profile title
     */
    public function getTitle();

    /**
     * Set the profile title.
     *
     * @param string The profile title.
     *
     * @return ProfileInterface The profile instance
     */
    public function setTitle($title);

    /**
     * Set the cache directory.
     *
     * @param string $directory An existing and writeable directory to store the cached data
     *
     * @return ProfileInterface The profile instance
     */
    public function setCacheDirectory($directory);

    /**
     * Get the cache directory.
     *
     * @return string The cache directory
     */
    public function getCacheDirectory();

    /**
     * Get data from MaPS System® and convert them.
     *
     * @param array $options A list of options to modify the default bahaviors
     */
    public function getData(array $options = array());

}
