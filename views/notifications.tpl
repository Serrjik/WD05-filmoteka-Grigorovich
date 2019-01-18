<?php if ( @$resultSuccess != '' ) { ?>
	<div class="notify notify--success mb-20"><?=$resultSuccess?></div>
<?php } ?>

<?php if ( @$resultInfo != '' ) { ?>
	<div class="notify notify--info mb-20"><?=$resultInfo?></div>
<?php } ?>

<?php if ( @$resultError != '' ) { ?>
	<div class="notify notify--error mb-20"><?=$resultError?></div>
<?php } ?>