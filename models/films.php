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
function film_new($link, $title, $genre, $year, $description = '') {

	// Запись фильма в БД
	$query = "INSERT INTO `films` (`title`, `genre`, `year`, `description`) VALUES (
	'" . mysqli_real_escape_string($link, $title) . "',
	'" . mysqli_real_escape_string($link, $genre) . "',
	'" . mysqli_real_escape_string($link, $year) . "',
	'" . mysqli_real_escape_string($link, $description) . "'
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

	echo "<pre>";
	print_r($_FILES);
	echo "</pre>";

	if ( isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] != "" ) {
		$fileName = $_FILES['photo']['name'];
		$fileTmpLoc = $_FILES['photo']['tmp_name'];
		$fileType = $_FILES['photo']['type'];
		$fileSize = $_FILES['photo']['size'];
		$fileErrorMsg = $_FILES['photo']['error'];
		$kaboom = explode(".", $fileName);
		$fileExt = end($kaboom);

		list($width, $height) = getimagesize($fileTmpLoc);
		if ( $width < 10 || $height < 10 ) {
			$errors[] = 'That image has no dimensions';
		}

		$db_file_name = rand(100000000000, 999999999999) . "." . $fileExt;
		if ( $fileSize > 2097152 ) {
			$errors[] = 'Размер вашего изображения превышает 2 Мбайт';
		} else if ( !preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName) ) {
			$errors[] = 'Ваше изображения не соответствует типам gif, jpg, jpeg, png';
		} else if ( $fileErrorMsg == 1 ) {
			$errors[] = 'Произошла неизвестная ошибка';
		}

	}

	$query = "UPDATE films 
		SET title = '" . mysqli_real_escape_string($link, $title) . "', 
			genre = '" . mysqli_real_escape_string($link, $genre) . "', 
			year = '" . mysqli_real_escape_string($link, $year) . "',
			description = '" . mysqli_real_escape_string($link, $description) . "'
			WHERE id = " . mysqli_real_escape_string($link, $id) . " LIMIT 1
	";

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

?>