<?php

	// mysqli_connect(server, user, pass, db-name);
	// DB connection
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

	// Add user to DB from Form
	print_r($_POST);

	if ( array_key_exists('add-user', $_POST) ) {
		if ( $_POST['name'] == '' ) {
			echo "<p>Необходимо ввести имя!</p>";
		} else if ( $_POST['password'] == '' ) {
			echo "<p>Необходимо ввести пароль!</p>";
		} else if ( $_POST['email'] == '' ) {
			echo "<p>Необходимо ввести Email!</p>";
		} else {
			$query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (
			'" . mysqli_real_escape_string($link, $_POST['name']) . "',
			'" . mysqli_real_escape_string($link, $_POST['email']) . "',
			'" . mysqli_real_escape_string($link, $_POST['password']) . "'
		)";

		if ( mysqli_query($link, $query) ) {
			echo "<p>Пользователь был добавлен!</p>";
		} else 
			echo "<p>Пользователь НЕ был добавлен! Произошла ошибка</p>";
		}
	}

	// $query = "INSERT INTO `users` (`email`, `password`) VALUES ('joker@mail.ru', '777')";

	// LIMIT 1 - ограничение изменений на изменения только в 1 ряду

	// $query = "UPDATE `users` SET `email` = 'joker@hotmail.org' WHERE `id` = 3 LIMIT 1";
	
	// $query = "UPDATE `users` SET `password` = '654321' WHERE `email` = 'joker@hotmail.org' LIMIT 1";

	// $query = "SELECT * FROM `users` WHERE `id` = 1";
	// $query = "SELECT * FROM `users` WHERE `email` = 'joker@hotmail.org'";

	// LIKE - выбирает те записи, которые выглядят как заданная, т.е. не строго равные
	// $query = "SELECT * FROM `users` WHERE `email` LIKE 'joker@hotmail.org'";

	// % в данном запросе означает любое количество любых символов
	// $query = "SELECT * FROM `users` WHERE `email` LIKE '%hotmail.com'";
	// $query = "SELECT * FROM `users` WHERE `email` LIKE '%man%'";
	// $query = "SELECT * FROM `users` WHERE `id` > 5";
	// $query = "SELECT * FROM `users` WHERE `id` >= 5";
	// $query = "SELECT * FROM `users` WHERE `id` >= 2 AND `email` LIKE '%hotmail.com'";

	// $name = "Brayan O\'Konor";
	// $name = "Brayan O'Konor";

	// Функция mysqli_real_escape_string($link, $name) экранирует символы

	// $query = "SELECT * FROM `users` WHERE `name` = '" .
	/*mysqli_real_escape_string($link, $name) .
	"'";*/

	// QUERY USERS
	$query = "SELECT * FROM `users`";
	$users = array();

	if ( $result = mysqli_query($link, $query) ) {
		
		while ( $row = mysqli_fetch_array($result) ) {
			$users[] = $row;
		}
	}

?>

<h1>ТАБЛИЦА С ПОЛЬЗОВАТЕЛЯМИ</h1>

<table border="1">
	<thead>
		<tr>
			<th>ID</th>
			<th>Имя</th>
			<th>Email</th>
			<th>Пароль</th>
		</tr>
	</thead>
	<tbody>

		<?php

		foreach ($users as $key => $value) {
		?>
		<tr>
			<td><?php echo $users[$key]['id'] ?></td>
			<td><?php echo $users[$key]['name']; ?></td>
			<td><?php echo $users[$key]['email']; ?></td>
			<td><?php echo $users[$key]['password']; ?></td>
		</tr>
		<?php
		}

		?>
	</tbody>
</table>

<h2>ФОРМА ДОБАВЛЕНИЯ ПОЛЬЗОВАТЕЛЯ</h2>

<form action="index.php" method="POST">
	<input type="text" placeholder="Введите имя" name="name">
	<input type="email" placeholder="Введите email" name="email">
	<input type="password" placeholder="Введите пароль" name="password">
	<input type="submit" value="Добавить пользователя" name="add-user">
</form>