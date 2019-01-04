<?php

	// mysqli_connect(server, user, pass, db-name);
	$link = mysqli_connect('localhost', 'root', '', 'mini-site');

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

	// $query = "INSERT INTO `users` (`email`, `password`) VALUES ('joker@mail.ru', '777')";

	// LIMIT 1 - ограничение изменений на изменения только в 1 ряду

	// $query = "UPDATE `users` SET `email` = 'joker@hotmail.org' WHERE `id` = 3 LIMIT 1";
	
	// $query = "UPDATE `users` SET `password` = '654321' WHERE `email` = 'joker@hotmail.org' LIMIT 1";

	// $query = "SELECT * FROM `users`";
	// $query = "SELECT * FROM `users` WHERE `id` = 1";
	// $query = "SELECT * FROM `users` WHERE `email` = 'joker@hotmail.org'";

	// LIKE - выбирает те записи, которые выглядят как заданная, т.е. не строго равные
	// $query = "SELECT * FROM `users` WHERE `email` LIKE 'joker@hotmail.org'";

	// % в данном запросе означает любое количество любых символов
	// $query = "SELECT * FROM `users` WHERE `email` LIKE '%hotmail.com'";
	// $query = "SELECT * FROM `users` WHERE `email` LIKE '%man%'";
	// $query = "SELECT * FROM `users` WHERE `id` > 5";
	// $query = "SELECT * FROM `users` WHERE `id` >= 5";
	$query = "SELECT * FROM `users` WHERE `id` >= 2 AND `email` LIKE '%hotmail.com'";

	if ( $result = mysqli_query($link, $query) ) {
		
		while ( $row = mysqli_fetch_array($result) ) {
			echo "<pre>";
			print_r($row);
			echo "</pre>";
		}
	}

?>