<h1 class="title-1">Редактировать фильм</h1>

<div class="panel-holder mt-80 mb-40">

	<form action="edit.php?id=<?=@$film['id']?>" method="POST">

		<?php
		if ( !empty($errors) ) {
			foreach ($errors as $key => $value) {
				echo "<div class='notify notify--error mb-20'>$value</div>";
			}
		}
		?>

		<div class="form-group">
			<label class="label">Название фильма
				<input class="input" name="title" type="text" placeholder="Такси 2" value="<?=@$film['title']?>" />
			</label>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label class="label">Жанр
						<input class="input" name="genre" type="text" placeholder="комедия" value="<?=@$film['genre']?>" />
					</label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label class="label">Год
						<input class="input" name="year" type="text" placeholder="2000" value="<?=@$film['year']?>" />
					</label>
				</div>
			</div>
		</div>
		<textarea class="textarea mb-20" name="description" placeholder="Введите описание фильма"><?=@$film['description']?></textarea>
		<input class="button" type="submit" name="editFilm" value="Изменить информацию" />
	</form>
</div>