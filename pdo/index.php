<?php

// Подключение к БД через PDO
// $db - объект PDO
// new PDO(тип БД и имя хоста и имя БД, имя пользователя, пароль, 4-й необязательный параметр с настройками)
$db = new PDO('mysql:host=localhost;dbname=WD05-filmoteka-Grigorovich', 'root', '');

$sql = "SELECT * FROM films";

// Метод query() выполняет запросы. Возвращает объект PDO
$result = $db->query($sql);

// 1.
// echo "<h2>Вывод записей из результата по одной: </h2>";

// Метод fetch() возвращает каждый раз по одной записи из БД
/*while ( $film = $result->fetch(PDO::FETCH_ASSOC) ) {
	// echo "<pre>";
	// print_r($film);
	// echo "</pre>";
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br><br>";
}*/

// 2.
// Метод fetchAll() возвращает сразу все данные, что были получены
/*$films = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Выборка всех записей в массив и вывод на экран:</h2>";
foreach ($films as $film) {
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br><br>";
}*/

// 3.
// Вывод всех значений в переменные
// Метод bindColumn() берет каждую колонку из таблицы для каждого фильма и будет создавать для неё переменную
// Для колонки id необходимо создать переменную $id
$result->bindColumn('id', $id);
$result->bindColumn('title', $title);
$result->bindColumn('genre', $genre);
$result->bindColumn('year', $year);

echo "<h2>Вывод записей с привязкой данных к переменным:</h2>";
while ( $result->fetch(PDO::FETCH_ASSOC) ) {
	echo "ID: {$id} <br>";
	echo "Название фильма: {$title} <br>";
	echo "Жанр фильма: {$genre} <br>";
	echo "Год: {$year} <br><br><br>";
}

?>