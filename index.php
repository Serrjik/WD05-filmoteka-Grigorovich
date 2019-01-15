<?php

// DB connection
require('config.php');
require('database.php');
$link = db_connect();
require('models/films.php');

$films = films_all($link);

include('views/head.tpl');
include('views/index.tpl');
include('views/footer.tpl');

?>