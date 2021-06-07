<?php

/**
 * Class SongsController
 * This is a demo Controller class.
 *
 * If you want, you can use multiple Models or Controllers.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Constants\Constants;
use Mini\Model\Song;

class SongsController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    final public function index()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        /** @noinspection PhpIncludeInspection */
        require APP . Constants::ROUTE_HEADER;
        require APP . Constants::ROUTE_SONGS.'index.php';
        /** @noinspection PhpIncludeInspection */
        require APP . Constants::ROUTE_FOOTER;
    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on songs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addSong()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_song"])) {
            // Instance new Model (Song)
            $Song = new Song();
            // do addSong() in model/model.php
            $Song->addSong($_POST["artist"], $_POST["track"],  $_POST["link"]);
        }

        // where to go after song has been added
        header(Constants::LOCATION.': ' . URL . Constants::SONGS.'/'.Constants::INDEX);
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function deleteSong($song_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($song_id)) {
            // Instance new Model (Song)
            $Song = new Song();
            // do deleteSong() in model/model.php
            $Song->deleteSong($song_id);
        }

        // where to go after song has been deleted
        header(Constants::LOCATION.': ' . URL . Constants::SONGS.'/'.Constants::INDEX);
    }

    /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     * @param int $song_id Id of the to-edit song
     */
    public function editSong($song_id)
    {
        // if we have an id of a song that should be edited
        if (isset($song_id)) {
            // Instance new Model (Song)
            $Song = new Song();
            // do getSong() in model/model.php
            $song = $Song->getSong($song_id);

            // If the song wasn't found, then it would have returned false, and we need to display the error page
            if ($song === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // load views. within the views we can echo out $song easily
                /** @noinspection PhpIncludeInspection */
                require APP . Constants::ROUTE_HEADER;
                require APP . Constants::ROUTE_SONGS.'edit.php';
                /** @noinspection PhpIncludeInspection */
                require APP . Constants::ROUTE_FOOTER;
            }
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'songs/index');
        }
    }

    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a song" form on songs/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateSong()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_update_song"])) {
            // Instance new Model (Song)
            $Song = new Song();
            // do updateSong() from model/model.php
            $Song->updateSong($_POST["artist"], $_POST["track"],  $_POST["link"], $_POST['song_id']);
        }

        // where to go after song has been added
        header('location: ' . URL . 'songs/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     */
    public function ajaxGetStats()
    {
        // Instance new Model (Song)
        $Song = new Song();
        $amount_of_songs = $Song->getAmountOfSongs();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_songs;
    }

}
