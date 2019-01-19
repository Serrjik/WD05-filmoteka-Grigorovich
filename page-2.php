<?php

// Инициализируем сессию:
session_start();

// Выведем переменную name из сессии:
echo $_SESSION['name']. "<br>";
echo $_SESSION['city']. "<br>";

$_SESSION['city'] = 'Минск';

// Повторно инициализирует сессию, используя оригинальные значения, сохраненные в хранилище сессии. Эта функция требует наличия активной сессии и уничтожает все изменения в массиве $_SESSION
session_reset();

// Выведем переменную name из сессии:
echo $_SESSION['name']. "<br>";
echo $_SESSION['city']. "<br>";

?>

<a href="index.php">Index</a>