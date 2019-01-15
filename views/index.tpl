<div class="title-1">Фильмотека</div>

<?php foreach ($films as $recordNumber => $value) { ?>
	<div class="card mb-20">
		<div class="card__header">
			<h4 class="title-4"><?=$films[$recordNumber]['title']?></h4>
			<div>
				<a class="button button--editsmall" href="edit.php?action=edit&id=<?=$films[$recordNumber]['id']?>">Редактировать</a>
				<a class="button button--removesmall" href="?action=delete&id=<?=$films[$recordNumber]['id']?>">Удалить</a>
			</div>
		</div>
		<div class="badge"><?=$films[$recordNumber]['genre']?></div>
		<div class="badge"><?=$films[$recordNumber]['year']?></div>
	</div>
<?php }?>