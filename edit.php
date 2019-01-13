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
	$resultOfUpdating = '';

	// Update film in DB from Form
	if ( array_key_exists('editFilm', $_POST) && ($_POST['editFilm'] == "Изменить информацию" ) ) {
		if ( trim($_POST['title']) == '' ) {
			$title = mysqli_real_escape_string($link, trim($_POST['previousTitle']));
		} else {
			$title = mysqli_real_escape_string($link, trim($_POST['title']));
		}
		if ( trim($_POST['genre']) == '' ) {
			$genre = mysqli_real_escape_string($link, trim($_POST['previousGenre']));
		} else {
			$genre = mysqli_real_escape_string($link, trim($_POST['genre']));
		}
		if ( trim($_POST['year']) == '' ) {
			$year = mysqli_real_escape_string($link, trim($_POST['previousYear']));
		} else {
			$year = mysqli_real_escape_string($link, trim($_POST['year']));
		}

		$updatingQuery = "UPDATE films 
			SET title = '$title', 
				genre = '$genre', 
				year = '$year'
				WHERE id = " . mysqli_real_escape_string($link, ($_GET['id'])) . " LIMIT 1
		";

		if ( mysqli_query($link, $updatingQuery) ) {
			$resultOfUpdating = '<div class="notify notify--info mb-20">Информация о фильме была изменена!</div>';
		} else {
			$resultOfUpdating = '<div class="notify notify--error mb-20">Информация о фильме НЕ была изменена! Произошла ошибка</div>';
		}
	}

	// Delete film from DB
	if ( $_GET ) {
		if ( @$_GET['action'] == 'delete' ) {

			// query for delete film
			$query = "DELETE FROM films WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "'";

			mysqli_query($link, $query);

			if ( mysqli_affected_rows($link) == 1 ) {
				$resultOfRemoval = '<div class="notify notify--info mb-20">Фильм был удалён!</div>';
			}
		}

	}

	// Getting film from DB
	// query for select film
	$query = "SELECT * FROM `films` WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "' LIMIT 1";

	$result = mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) == 1 ) {
		$film = mysqli_fetch_array($result);
	}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>Сергей Григорович - Фильмотека</title>
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
		<div class="title-1"><?=@$film['title']?></div>
		<?php
			if ( $resultOfRemoval ) {
				echo $resultOfRemoval;
			}
		?>
		<div class="panel-holder mt-0 mb-20">
			<div class="title-3 mt-0">Редактировать фильм</div>
			<?php if ( $resultOfInsertion != '' ) {
					echo $resultOfInsertion;
				}
				if ( $resultOfUpdating != '' ) {
					echo $resultOfUpdating;
				}
			?>

			<form action="edit.php?id=<?=@$film['id']?>" method="POST">
				<div class="form-group">
					<label class="label">Название фильма<input class="input" name="title" type="text" placeholder="<?=@$film['title']?>" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="<?=@$film['genre']?>" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="<?=@$film['year']?>" /></label></div>
					</div>
				</div>
				<input type="hidden" name="previousTitle" value="<?=@$film['title']?>" />
				<input type="hidden" name="previousGenre" value="<?=@$film['genre']?>" />
				<input type="hidden" name="previousYear" value="<?=@$film['year']?>" />
				<input class="button" type="submit" name="editFilm" value="Изменить информацию" />
				<a class="button button--removesmall" href="?action=delete&id=<?=$film['id']?>">Удалить</a>

			</form>
		</div>

		<div class="mb-100">
			<a href="index.php" class="button">Вернуться на главную</a>
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