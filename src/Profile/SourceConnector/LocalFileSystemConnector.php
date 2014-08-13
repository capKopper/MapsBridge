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

namespace MapsSystem\Bridge\Profile\SourceConnector;

/**
 * This trait intends to get the MaPS System® data from the local filesystem.
 *
 * @todo finalize this implementation!
 */
trait LocalFileSystemConnector
{

    /**
     * The local path to the source files.
     *
     * @var string
     */
    protected $directory;

    /**
     * Class constructor.
     */
    public function __construct($directory)
    {
      $this->directory = $directory;
    }

    /**
     * (@inheritdoc)
     *
     * @todo implement this
     */
    protected function retrieveData(array $options = array())
    {
        return '';
    }

}
