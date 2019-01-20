<?php

require('config.php');

if ( isset($_POST['user-submit']) ) {
	$userName = $_POST['user-name'];
	$userCity = $_POST['user-city'];
	// Время существования cookie
	$expire = time() + 60*60*24*40;
	
	setcookie('user-name', $userName, $expire);
	setcookie('user-city', $userCity, $expire);
}

header('Location: ' . HOST . 'request.php');

?>