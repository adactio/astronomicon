<?php

require_once('init.php');

include 'templates/head.html';

$_OUTPUT['random'] = rand(1941,2010).'-'.str_pad(rand(1,12), 2, '0', STR_PAD_LEFT).'-'.str_pad(rand(1,28), 2, '0', STR_PAD_LEFT);

if (isset($_GET['date'])):
    $_OUTPUT['date'] = $_GET['date'];
endif;

echo $twig -> render(file_get_contents('templates/form.html'), $_OUTPUT);

if (isset($_GET['date'])):

    // Convert the input into a timestamp
    $timestamp = strtotime($_GET['date']);
    $_OUTPUT['date'] = date('l, F jS, Y', $timestamp);

    //Loop through the songs
    $_OUTPUT['song'] = array();
    foreach($_DATA['songs'] as $loopsong):
        //Convert the date to a timestamp
        $songdate = strtotime($loopsong['date']);
        if ($songdate < $timestamp):
            $_OUTPUT['song'] = $loopsong;
            break;
        endif;
    endforeach;

    if (empty($_OUTPUT['song'])):
        echo $twig -> render(file_get_contents('templates/nosong.html'), $_OUTPUT);
    else:

        // Grab the current time as a timestamp
        $now = time();
        // Calculate the difference between then and now (in seconds)
        $elapsed = $now - $timestamp;
        // Convert the elapsed time into years
        $lightyears = $elapsed/60/60/24/365;
        // Calculate the distance in parsecs
        $parsecs = $lightyears*0.306594845;

        //Loop through the stars
        $_OUTPUT['star'] = array();
        foreach ($_DATA['stars'] as $loopstar):
            if (floatval($parsecs) > floatval($loopstar['distance'])):
                $_OUTPUT['star'] = $loopstar;
                break;
            endif;
        endforeach;

        if (empty($_OUTPUT['star'])):
            //Nothing matched.
            echo $twig -> render(file_get_contents('templates/nostar.html'), $_OUTPUT);
        else:
            echo $twig -> render(file_get_contents('templates/result.html'), $_OUTPUT);
        endif;
    endif;
endif;

include 'templates/foot.html';

?>