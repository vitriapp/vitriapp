<?php

/**
 * File constants variables
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Constants;

/**
 * Class Constants
 * @package Mini\Constants
 */
class Constants
{

    const ROUTE_HEADER = 'view/_templates/header.php';
    const ROUTE_SONGS = 'view/songs/';
    const ROUTE_HOME = 'view/home/';
    const ROUTE_FOOTER = 'view/_templates/footer.php';
    const ID_SONG = ':song_id';
    const LOCATION = 'location';
    const SONGS = 'songs';
    const INDEX = 'index';
}
