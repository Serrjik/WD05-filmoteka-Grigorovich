<?php

function db_connect() {
	$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

	// Возвращает ошибку в случае если не получилось соединиться с базой данных
	if ( mysqli_connect_error() ) {
		// Полностью блокирует выполнение скрипта
		die("Ошибка подключения к базе данных.");
	}

	if ( !mysqli_set_charset($link, "utf8") ) {
		printf("Error: " . mysqli_error($link));
	}

	return $link;
}

?>