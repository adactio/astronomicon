<?php require_once('init.php'); ?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Radio Free Earth</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div class="block">
          <form action="?" method="get">
            <label for="date">Enter a date</label>
            <input type="date" id="date" name="date"<?php if(isset($_GET['date'])): echo ' value="'.$_GET['date'].'"'; endif; ?>/>
            <button type="submit">Submit</button>
          </form>
<?php

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
        else:
?>
        <div class="block">
          <p>
            On <?php echo date('l, F jS, Y', $timestamp); ?>, <?php echo strip_tags($song['title']); ?> by <?php echo strip_tags($song['artist']); ?> was Earth's #1 song. Its magic has just reached <?php echo $star['name']; ?>.
          </p>  
        </div>
<?php
        endif;
    endif;
endif;

?>
    </body>
</html>