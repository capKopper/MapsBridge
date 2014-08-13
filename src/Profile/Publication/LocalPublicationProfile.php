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

namespace MapsSystem\Bridge\Profile\Publication;

use MapsSystem\Bridge\Profile\SourceConnector as Connector;

/**
 * This class defines a MaPS System® profile based on publication data and
 * populated through local files, that are synchronized using MaPS System®
 * SFTP/SSH plugin or another way.
 *
 * This class does not take care about synchronizing those source files, but
 * only retrieve the data if they exist.
 *
 * @todo implement this!
 */
class LocalPublicationProfile extends AbstractPublicationProfile
{

    use Connector\LocalFileSystemConnector;

}
