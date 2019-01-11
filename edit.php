<?php

	// DB connection
	$link = mysqli_connect('localhost', 'root', '', 'WD05-filmoteka-Grigorovich');

	// Возвращает ошибку в случае если не получилось соединиться с базой данных
	if ( mysqli_connect_error() ) {
		// Полностью блокирует выполнение скрипта
		die("Ошибка подключения к базе данных.");
	}

	// Set initial values of variables
	$resultOfInsertion = '';
	$resultOfRemoval = '';

	// Delete film from DB
/*	if ( $_GET ) {
		if ( $_GET['action'] == 'delete' ) {

			// query for delete film
			$query = "DELETE FROM films WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "'";

			mysqli_query($link, $query);

			if ( mysqli_affected_rows($link) == 1 ) {
				$resultOfRemoval = '<div class="notify notify--info mb-20">Фильм был удалён!</div>';
			}
		}

	}*/

	// Edit film
	if ( $_GET ) {
		if ( $_GET['action'] == 'edit' ) {

			// query for edit film
			$query = "SELECT * FROM `films` WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "'";

			$result = mysqli_query($link, $query);

			if ( mysqli_affected_rows($link) == 1 ) {
				$film = mysqli_fetch_array($result);
				// echo "<pre>";
				// print_r($film);
				// echo "</pre>";

			}

		}
	}

	if ( $_GET ) {
		if ($_GET['name'] == 'editFilm' ) {
			$insertionQuery = "INSERT INTO films 
			(title, genre, year) 
			VALUES (
			'" . mysqli_real_escape_string($link, trim($_POST['title'])) . "', 
			'" . mysqli_real_escape_string($link, trim($_POST['genre'])) . "', 
			'" . mysqli_real_escape_string($link, trim($_POST['year'])) . "'
			)";
			
		}

	}

	// Add film to DB from Form

/*	if ( array_key_exists('newFilm', $_POST) && ($_POST['newFilm'] == "Добавить" ) ) {
		if ( trim($_POST['title']) == '' ) {
			$resultOfInsertion = '<div class="notify notify--error mb-20">Название фильма не может быть пустым.</div>';
		} else if ( trim($_POST['genre']) == '' ) {
			$resultOfInsertion = '<div class="notify notify--error mb-20">Жанр фильма не может быть пустым.</div>';
		} else if ( trim($_POST['year']) == '' ) {
			$resultOfInsertion = '<div class="notify notify--error mb-20">Год выхода фильма не может быть пустым.</div>';
		} else {
			$query = "INSERT INTO `films` (`title`, `genre`, `year`) VALUES (
			'" . mysqli_real_escape_string($link, trim($_POST['title'])) . "',
			'" . mysqli_real_escape_string($link, trim($_POST['genre'])) . "',
			'" . mysqli_real_escape_string($link, trim($_POST['year'])) . "'
		)";

		if ( mysqli_query($link, $query) ) {
			$resultOfInsertion = '<div class="notify notify--success mb-20">Фильм был добавлен!</div>';
		} else
			$resultOfInsertion = '<div class="notify error mb-20">Фильм НЕ был добавлен! Произошла ошибка</div>';
		}
	}*/

	// QUERY for films
/*	$query = "SELECT * FROM `films`";
	$films = array();

	if ( $result = mysqli_query($link, $query) ) {
		
		while ( $row = mysqli_fetch_array($result) ) {
			$films[] = $row;
		}
	}*/

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>[Имя и фамилия] - Фильмотека</title>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
	<meta name="keywords" content="" />
	<meta name="description" content="" /><!-- build:cssVendor css/vendor.css -->
	<link rel="stylesheet" href="libs/normalize-css/normalize.css" />
	<link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css" />
	<link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css" /><!-- endbuild -->
	<!-- build:cssCustom css/main.css -->
	<link rel="stylesheet" href="./css/main.css" /><!-- endbuild -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
</head>

<body class="index-page">
	<div class="container user-content section-page">
		<div class="title-1">Фильмотека</div>
		<?php
			if ( $resultOfRemoval ) {
				echo $resultOfRemoval;
			}

/*			foreach ($films as $recordNumber => $value) { ?>
				<div class="card mb-20">
					<div class="card__header">
						<h4 class="title-4"><?=$films[$recordNumber]['title']?></h4>
						<a class="button button--remove" href="?action=delete&id=<?=$films[$recordNumber]['id']?>">Удалить</a>
					</div>
					<div class="badge"><?=$films[$recordNumber]['genre']?></div>
					<div class="badge"><?=$films[$recordNumber]['year']?></div>
				</div>
			<?php }*/
		?>
		<div class="panel-holder mt-80 mb-40">
			<div class="title-3 mt-0">Редактировать фильм</div>
			<?php if ( $resultOfInsertion != '' ) {
				echo $resultOfInsertion;
				}
			?>
			<?php
				$id = mysqli_real_escape_string($link, $_GET['id']);
			?>

			<form action="index.php" method="GET">
				<div class="form-gr`oup"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="<?=$film['title']?>" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="<?=$film['genre']?>" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="<?=$film['year']?>" /></label></div>
					</div>
				</div><input class="button" type="submit" name="editFilm" value="Изменить информацию" />
			</form>
		</div>
	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
	<!-- build:jsVendor js/vendor.js -->
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>