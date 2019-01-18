<?php

// DB connection
require('config.php');
require('database.php');
require('models/films.php');

$link = db_connect();

if ( array_key_exists('newFilm', $_POST) && ($_POST['newFilm'] == "Добавить" ) ) {

	// Обработка ошибок
	if ( trim($_POST['title']) == '' ) {
		$errors[] = 'Название фильма не может быть пустым.';
	}
	if ( trim($_POST['genre']) == '' ) {
		$errors[] = 'Жанр фильма не может быть пустым.';
	}
	if ( trim($_POST['year']) == '' ) {
		$errors[] = 'Год выхода фильма не может быть пустым.';
	}

	// Если ошибок нет - записываем фильм в БД
	if ( empty($errors) ) {
		$result = film_new($link, trim($_POST['title']), trim($_POST['genre']), trim($_POST['year']), trim($_POST['description']), $_FILES['photo']);

		if ( $result ) {
			$resultSuccess = "<p>Фильм был успешно добавлен!</p>";
		} else {
			$resultError = "<p>Фильм НЕ был добавлен. Попробуйте добавить его ещё раз!</p>";
		}
	}

}

include('views/head.tpl');
include('views/notifications.tpl');
include('views/new-film.tpl');
include('views/footer.tpl');

?>