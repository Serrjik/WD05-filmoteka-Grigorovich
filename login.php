<?php

require('config.php');
require('database.php');
$link = db_connect();
require('models/films.php');
require('functions/login-functions.php');

if ( isset($_POST['enter']) ) {

	$user = check_admin($link, trim($_POST['login']), trim($_POST['password']));

	if ( $user == false ) {
		$errorLogin = "Неправильное имя пользователя или пароль!";
	} else {
		$_SESSION['user'] = 'admin';
		header('Location: ' . HOST . 'index.php');
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