<?php

	// DB connection
	require('config.php');
	require('database.php');
	$link = db_connect();

	films_all($link);

	// Set initial values of variables
	$resultOfInsertion = '';
	$resultOfRemoval = '';

	// Delete film from DB
	if ( $_GET ) {
		if ( $_GET['action'] == 'delete' ) {

			// query for delete film
			$query = "DELETE FROM films WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "'";

			mysqli_query($link, $query);

			if ( mysqli_affected_rows($link) == 1 ) {
				$resultOfRemoval = '<div class="notify notify--info mb-20">Фильм был удалён!</div>';
			}
		}

	}



?>


		
		<?php
			if ( $resultOfRemoval ) {
				echo $resultOfRemoval;
			}


		?>
		<div class="panel-holder mt-80 mb-40">
			<div class="title-3 mt-0">Добавить фильм</div>
			<?php if ( $resultOfInsertion != '' ) {
				echo $resultOfInsertion;
				}
			?>
			<form action="index.php" method="POST">
				<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Такси 2" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" /></label></div>
					</div>
				</div><input class="button" type="submit" name="newFilm" value="Добавить" />
			</form>
		</div>
