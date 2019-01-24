<?php

// -------------------------------
// Простой выбор данных из БД
// -------------------------------

// Подключение к БД через PDO
// $db - объект PDO
// new PDO(тип БД и имя хоста и имя БД, имя пользователя, пароль, 4-й необязательный параметр с настройками)
$db = new PDO('mysql:host=localhost;dbname=WD05-filmoteka-Grigorovich', 'root', '');

$sql = "SELECT * FROM films";

// Метод query() выполняет запросы. Возвращает объект PDO
$result = $db->query($sql);

// 1.
echo "<h2>Вывод записей из результата по одной: </h2>";

// Метод fetch() возвращает каждый раз по одной записи из БД
while ( $film = $result->fetch(PDO::FETCH_ASSOC) ) {
	// echo "<pre>";
	// print_r($film);
	// echo "</pre>";
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br><br>";
}

// 2.
// Метод fetchAll() возвращает сразу все данные, что были получены
// $films = $result->fetchAll(PDO::FETCH_ASSOC);

/*echo "<h2>Выборка всех записей в массив и вывод на экран:</h2>";
foreach ($films as $film) {
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br><br>";
}
*/
// 3.
// Вывод всех значений в переменные
// Метод bindColumn() берет каждую колонку из таблицы для каждого фильма и будет создавать для неё переменную
// Для колонки id необходимо создать переменную $id
/*$result->bindColumn('id', $id);
$result->bindColumn('title', $title);
$result->bindColumn('genre', $genre);
$result->bindColumn('year', $year);

echo "<h2>Вывод записей с привязкой данных к переменным:</h2>";
while ( $result->fetch(PDO::FETCH_ASSOC) ) {
	echo "ID: {$id} <br>";
	echo "Название фильма: {$title} <br>";
	echo "Жанр фильма: {$genre} <br>";
	echo "Год: {$year} <br><br><br>";
}*/

// -------------------------------
// Выбор данных из БД с защитой
// -------------------------------

// $db = new PDO('mysql:host=localhost;dbname=new-mini-site', 'root', '');

// 1. Выборка без защиты от SQL инъекции
/*$username = 'Joker';
$password = '555';*/

// $sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
// $result = $db->query($sql);

// echo "<h2>Выборка записи без защиты от SQL инъекции:</h2>";
/*echo "<pre>";
print_r( $result->fetch(PDO::FETCH_ASSOC) );
echo "</pre>";*/
/*if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']}<br>";
	echo "Пароль пользователя: {$user['email']}<br>";
}*/

// 2. Выборка с защитой от SQL инъекции - В РУЧНОМ режиме - НЕ рекомендуется использовать. Лучше следующий метод

// функция quote() заключает строку в кавычки (если требуется) и экранирует специальные символы внутри строки подходящим для драйвера способом
// $db->quote( $username );
// функция strtr() экранирует символы (делает замену одних символов на другие, преобразует заданные символы)
// $username = strtr($username, array('_' => '\_', '%' => '\%'));

/*$db->quote( $password );
$password = strtr($password, array('_' => '\_', '%' => '\%'));*/

// $sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";

/*$result = $db->query($sql);

echo "<h2>Выборка записи с защитой от SQL инъекции - В РУЧНОМ режиме:</h2>";*/
// echo "<pre>";
// print_r( $result->fetch(PDO::FETCH_ASSOC) );
// echo "</pre>";
/*if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']}<br>";
	echo "Пароль пользователя: {$user['email']}<br>";
}*/

// 3. Выборка с защитой от SQL инъекции - В АВТОМАТИЧЕСКОМ режиме
// В переменные :username и :password будут подставляться нужные значения
// $sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";
// // Метод prepare() подготавливает SQL-запрос
// $stmt = $db->prepare($sql);

// // Подставляем пользовательские данные в подготовленный SQL-запрос (более наглядный вариант с точки зрения чтения кода)
// $stmt->bindValue(':username', $username);
// $stmt->bindValue(':password', $password);
// $stmt->execute();

// // Если не хотим для каждого значения вызывать метод bindValue то можно сразу в ->execute
// // $stmt->execute(array(':username' => $username, ':password' => $password));

// $stmt->bindColumn('name', $name);
// $stmt->bindColumn('email', $email);

// echo "<h2>Выборка записи с автоматической защитой от SQL инъекции:</h2>";
// $stmt->fetch();
// echo "Имя пользователя: {$name}<br>";
// echo "Email пользователя: {$email}<br>";

// 4. Выборка с защитой от SQL инъекции - В АВТОМАТИЧЕСКОМ режиме - ТОЛЬКО ДРУГОЙ ФОРМАТ ЗАПРОСА
/*$sql = "SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1";
$stmt = $db->prepare($sql);*/

// Передаём пользовательские переменные в функцию htmlentities() для преобразования переменных (заменяет символы типа < на выражения типа &lt;) с целью защиты от межсайтового скриптинга (XSS-атак)
/*$username = htmlentities($username);
$password = htmlentities($password);*/

// Передаём в метод bindValue() первый по очереди параметр в SQL-запросе и переменную, которую нужно подставить на его место.
// Затем второй по очереди параметр в SQL-запросе и переменную, которую нужно подставить на его место.
/*$stmt->bindValue(1, $username);
$stmt->bindValue(2, $password);
$stmt->execute();*/

/*$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);*/

// Более краткий вариант записи:
// $stmt->execute( array($username, $password) );

/*echo "<h2>Выборка записи с автоматической защитой от SQL инъекции:</h2>";
$stmt->fetch();
echo "Имя пользователя: {$name}<br>";
echo "Email пользователя: {$email}<br>";

$string = "<script>Hello from script</script>";
$string = htmlentities($string);
echo $string;*/

// ---------------------------
// Вставка данных в БД
// ---------------------------

// $db = new PDO('mysql:host=localhost;dbname=new-mini-site', 'root', '');

/*// Готовим запрос в БД
// :name, :email, :password - плэйсхолдеры, куда будет подставляться информация
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $db->prepare($sql);

$username = 'Flash';
$useremail = 'flash@gmail.com';
$password = '777';

// 1-й вариант подстановки
$stmt->bindValue(':name', $username );
$stmt->bindValue(':email', $useremail );
$stmt->bindValue(':password', $password );
$stmt->execute();

// 2-й вариант подстановки
// $stmt->execute(array(':name' => $username, ':email' => $useremail, ':password' => $password));

// Метод rowCount() возвращает количество строк, затронутых последним SQL-запросом
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
// Метод lastInsertId() возвращает ID последней вставленной строки или значение последовательности
echo "<p>ID вставленной записи: " . $db->lastInsertId() . "</p>";*/

// ---------------------------
// Обновление данных
// ---------------------------

/*$sql = "UPDATE users SET name = :name WHERE id = :id";

// Обработка данных
$stmt = $db->prepare($sql);

$username = "New Flash";
$id = '13';

$stmt->bindValue(':name', $username);
$stmt->bindValue(':id', $id);
$stmt->execute();

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";*/

// ---------------------------
// Удаление данных
// ---------------------------

/*$sql = "DELETE FROM users WHERE name = :name";
$stmt = $db->prepare($sql);

$username = "New Flash";

$stmt->bindValue(':name', $username);
$stmt->execute();

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";*/

?>