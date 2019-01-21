<div class="title-1">Информация о фильме</div>

<div class="card mb-20">
	<!-- row -->
	<div class="row">
		<!-- col -->
		<div class="col">
			<img src="<?=HOST?>data/films/full/<?=$film['photo']?>" alt="<?=$film['title']?>">
		</div>
		<!-- // col -->

		<!-- col -->
		<div class="col">
			<div class="card__header">
				<h4 class="title-4"><?=$film['title']?></h4>
				<div>
				<?php if ( isset($_SESSION['user']) ) {
					if ( $_SESSION['user'] == 'admin' ) { ?>
					<a class="button button--editsmall mb-20" href="edit.php?action=edit&id=<?=$film['id']?>">Редактировать</a>
					<a class="button button--removesmall" href="index.php?action=delete&id=<?=$film['id']?>">Удалить</a>
				<?php }	} ?>
				</div>
			</div>
			<div class="badge"><?=$film['genre']?></div>
			<div class="badge"><?=$film['year']?></div>
			<div class="user-content">
				<p><?=$film['description']?></p>
			</div>
		</div>
		<!-- // col -->
	</div>
	<!-- // row -->

</div>