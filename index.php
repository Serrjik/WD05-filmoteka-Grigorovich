<?php

// DB connection
require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');
require('functions/login-functions.php');

// Delete film from DB
if ( $_GET ) {
	if ( $_GET['action'] == 'delete' ) {

		$result = film_delete($link, $_GET['id']);

		if ( $result ) {
			$resultInfo = "Фильм был удалён!";
		} else {
			$resultError = "Фильм НЕ был удалён!";
		}
	}

}

$films = films_all($link);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/index.tpl');
include('views/footer.tpl');

?>