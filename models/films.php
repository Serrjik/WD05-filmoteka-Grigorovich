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
function film_new($link, $title, $genre, $year, $description = '', $photo) {

	if ( isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] != "" ) {
		require_once(ROOT . "functions/stored_image_name.php");
		$db_file_name = getStoredImageName($photo);
	} else {
		$db_file_name = '';
	}

	// Запись фильма в БД
	$query = "INSERT INTO `films` (`title`, `genre`, `year`, `description`, `photo`) VALUES (
	'" . mysqli_real_escape_string($link, $title) . "',
	'" . mysqli_real_escape_string($link, $genre) . "',
	'" . mysqli_real_escape_string($link, $year) . "',
	'" . mysqli_real_escape_string($link, $description) . "',
	'" . mysqli_real_escape_string($link, $db_file_name) . "'
	)";

	if ( mysqli_query($link, $query) ) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;

}

// Getting film from DB
function get_film($link, $id) {
	// query for select 1 film
	$query = "SELECT * FROM `films` WHERE id = '" . mysqli_real_escape_string($link, $id) . "' LIMIT 1";

	$result = mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) == 1 ) {
		$film = mysqli_fetch_array($result);
	}
	
	return $film;

}

function film_update($link, $title, $genre, $year, $id, $description, $photo) {

	if ( isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] != "" ) {
		require_once(ROOT . "functions/stored_image_name.php");
		$db_file_name = getStoredImageName($photo);

		$query = "UPDATE films 
			SET title = '" . mysqli_real_escape_string($link, $title) . "', 
				genre = '" . mysqli_real_escape_string($link, $genre) . "', 
				year = '" . mysqli_real_escape_string($link, $year) . "',
				description = '" . mysqli_real_escape_string($link, $description) . "',
				photo = '" . mysqli_real_escape_string($link, $db_file_name) . "'
				WHERE id = " . mysqli_real_escape_string($link, $id) . " LIMIT 1
		";
	} else {
		$query = "UPDATE films 
			SET title = '" . mysqli_real_escape_string($link, $title) . "', 
				genre = '" . mysqli_real_escape_string($link, $genre) . "', 
				year = '" . mysqli_real_escape_string($link, $year) . "',
				description = '" . mysqli_real_escape_string($link, $description) . "'
				WHERE id = " . mysqli_real_escape_string($link, $id) . " LIMIT 1
		";
	}

	if ( mysqli_query($link, $query) ) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

function film_delete($link, $id) {
	// query for delete film
	$query = "DELETE FROM films WHERE id = '" . mysqli_real_escape_string($link, $id) . "' LIMIT 1";

	mysqli_query($link, $query);
	
	if ( mysqli_affected_rows($link) == 1 ) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

// Получить данные из таблицы с логином и паролем админа сайта
function check_admin($link, $username, $password) {

	$query = "SELECT * FROM `admin` 
	WHERE username = '" . mysqli_real_escape_string($link, $username) . "' 
		AND password = '" . mysqli_real_escape_string($link, $password) . "' LIMIT 1";

	if ( $result = mysqli_query($link, $query) ) {
		$user = mysqli_fetch_array($result);
	}

	return $user;
}

?>