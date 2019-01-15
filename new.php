<?php

// DB connection
require('config.php');
require('database.php');
$link = db_connect();

if ( array_key_exists('newFilm', $_POST) && ($_POST['newFilm'] == "Добавить" ) ) {
	film_new($link);
} 

?>