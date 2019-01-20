<?php

	// DB connection
	require('config.php');
	require('database.php');
	$link = db_connect();

	require('models/films.php');
	require('functions/login-functions.php');

	// Set initial values of variables
	$errors = array();

	// Update film in DB from Form
	if ( array_key_exists('editFilm', $_POST) && ($_POST['editFilm'] == "Изменить информацию" ) ) {
		if ( trim($_POST['title']) == '' ) {
			$errors[] = 'Название фильма не может быть пустым.';
		} else if ( trim($_POST['genre']) == '' ) {
			$errors[] = 'Жанр фильма не может быть пустым.';
		} else if ( trim($_POST['year']) == '' ) {
			$errors[] = 'Год выхода фильма не может быть пустым.';
		}

		// Если ошибок нет - сохраняем фильм
		if ( empty($errors) ) {
			// Запись фильма в БД
			$result = film_update($link, trim($_POST['title']), trim($_POST['genre']), trim($_POST['year']), $_GET['id'], $_POST['description'], $_FILES['photo']);

			if ( $result ) {
				$resultSuccess = 'Информация о фильме была изменена!';
			} else {
				$resultError = 'Информация о фильме НЕ была изменена! Произошла ошибка';
			}

		}

	}

	$film = get_film($link, $_GET['id']);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/edit-film.tpl');
include('views/footer.tpl');

?>