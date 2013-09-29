<?php

$_DATA = array();

$cosmos = json_decode(file_get_contents('src/cosmos.json'), true);

$_DATA['stars'] = $cosmos['cosmos']['star'];

$songs = json_decode(file_get_contents('src/songs.json'), true);

$_DATA['songs'] = array_reverse($songs['table']['songs']['song']);

?>