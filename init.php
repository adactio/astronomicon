<?php

$_DATA = array();

$cosmos = json_decode(file_get_contents('src/cosmos.json'), true);

$_DATA['stars'] = $cosmos['cosmos']['star'];

?>