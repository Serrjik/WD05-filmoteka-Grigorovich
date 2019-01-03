<?php

	// mysqli_connect(server, user, pass, db-name);
	mysqli_connect('localhost', 'root', '', 'mini-site');

	// Возвращает ошибку в случае если не получилось соединиться с базой данных
	// mysqli_connect_error();

/*	if ( mysqli_connect_error() ) {
		echo "Ошибка подключения к базе данных.";
	} else {
		echo "Подключение прошло успешно!";
	}*/

	if ( mysqli_connect_error() ) {
		// Полностью блокирует выполнение скрипта
		die("Ошибка подключения к базе данных.");
	}

?>