<?php

require('config.php');
require('functions/login-functions.php');

if ( isset($_POST['enter']) ) {
	$userName = 'admin';
	$userPassword = '123456';

	if ( $_POST['login'] == $userName ) {
		if ( $_POST['password'] == $userPassword ) {
			$_SESSION['user'] = 'admin';
			header('Location: ' . HOST . 'index.php');
		}		
	}
}

if ( isset($_POST['user-submit']) ) {
	$userName = $_POST['user-name'];
	$userCity = $_POST['user-city'];
	// Время существования cookie
	$expire = time() + 60*60*24*40;
	setcookie('user-name', $userName, $expire);
	setcookie('user-city', $userCity, $expire);
}

include('views/head.tpl');
include('views/login.tpl');
include('views/footer.tpl');

?>