<?php

require('config.php');

if ( isset($_POST['user-unset']) ) {
	$userName = '';
	$userCity = '';
	// Время существования cookie
	$expire = time() - 60*60*24*40;
	
	setcookie('user-name', $userName, $expire);
	setcookie('user-city', $userCity, $expire);
}

header('Location: ' . HOST . 'request.php');

?>