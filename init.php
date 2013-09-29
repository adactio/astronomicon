<?php

require_once('lib/Twig/Autoloader.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);

$_DATA = array();

$cosmos = json_decode(file_get_contents('src/cosmos.json'), true);

$_DATA['stars'] = $cosmos['cosmos']['star'];

$songs = json_decode(file_get_contents('src/songs.json'), true);

$_DATA['songs'] = array_reverse($songs['table']['songs']['song']);

$_OUTPUT = array();

?>