<?php

// Getting All films from DB
function films_all($link) {
	// QUERY for films
	$query = "SELECT * FROM `films` ORDER BY id DESC";
	$films = array();

	if ( $result = mysqli_query($link, $query) ) {

		while ( $row = mysqli_fetch_array($result) ) {
			$films[] = $row;
		}
	}

	return $films;
}

// Add film to DB from Form
function film_new($link, $title, $genre, $year) {

	// Обработка ошибок
	if ( $title == '' ) {
		$errors[] = '<div class="notify notify--error mb-20">Название фильма не может быть пустым.</div>';
	}
	if ( $genre == '' ) {
		$errors[] = '<div class="notify notify--error mb-20">Жанр фильма не может быть пустым.</div>';
	}
	if ( $year == '' ) {
		$errors[] = '<div class="notify notify--error mb-20">Год выхода фильма не может быть пустым.</div>';
	} 

	if ( empty($errors) ) {
		// Запись фильма в БД
		$query = "INSERT INTO `films` (`title`, `genre`, `year`) VALUES (
		'" . mysqli_real_escape_string($link, $title) . "',
		'" . mysqli_real_escape_string($link, $genre) . "',
		'" . mysqli_real_escape_string($link, $year) . "'
	)";

	if ( mysqli_query($link, $query) ) {
		$resultSuccess = '<div class="notify notify--success mb-20">Фильм был добавлен!</div>';
	} else
		$resultError = '<div class="notify error mb-20">Фильм НЕ был добавлен! Произошла ошибка</div>';
	}

}

?>