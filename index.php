<?php

require_once('init.php');

if (isset($_GET['date'])):

    // Convert the input into a timestamp
    $timestamp = strtotime($_GET['date']);

    //Loop through the songs
    $song = array();
    foreach($_DATA['songs'] as $loopsong):
        //Convert the date to a timestamp
        $songdate = strtotime($loopsong['date']);
        if ($songdate < $timestamp):
            $song = $loopsong;
            break;
        endif;
    endforeach;

    if (empty($song)):
        echo "no songs for that date.";
        exit;
    endif;

    // Grab the current time as a timestamp
    $now = time();
    // Calculate the difference between then and now (in seconds)
    $elapsed = $now - $timestamp;
    // Convert the elapsed time into years
    $lightyears = $elapsed/60/60/24/365;
    // Calculate the distance in parsecs
    $parsecs = $lightyears*0.306594845;

    //Loop through the stars
    $star = array();
    foreach ($_DATA['stars'] as $loopstar):
        if ($loopstar['distance'] > $parsecs):
            $star = $loopstar;
            break;
        endif;
    endforeach;

    if (empty($star)):
        //Nothing matched.
        echo 'Nothing matched.';
        exit;
    endif;

    echo $song['title'];
    echo $song['artist'];
    echo $star['name'];

endif;

?>