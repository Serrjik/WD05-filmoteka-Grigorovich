<?php

// DB connection
require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');

// Delete film from DB
if ( $_GET ) {
	if ( @$_GET['action'] == 'delete' ) {

		$result = film_delete($link, $_GET['id']);

		if ( $result ) {
			$resultInfo = "Фильм был удалён!";
		} else {
			$resultError = "Фильм НЕ был удалён!";
		}
	}

}

$film = get_film($link, $_GET['id']);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/film-single.tpl');
include('views/footer.tpl');

?>