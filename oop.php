<?php

/*// Person 1
$person1_name = 'Peter';
$person1_speciality = 'Programmer';
$person1_age = 25;

function person1_hello($name, $spec, $age) {
	echo "Hello! My name is $name. I am $spec and $age years old.";
}

person1_hello($person1_name, $person1_speciality, $person1_age);
echo "<br><br>";

// Person 2
$person2_name = 'Jane';
$person2_speciality = 'Web-designer';
$person2_age = 23;

function person2_hello($name, $spec, $age) {
	echo "Hello! My name is $name. I am $spec and $age years old.";
}

person2_hello($person2_name, $person2_speciality, $person2_age);*/

// Описание объекта
class Person {
	public $name;
	public $speciality;
	public $age;

	// function __construct(argument)
	// {
	// 	# code...
	// }

	public function greeting($name, $spec, $age) {
		echo "Hello! My name is $name. I am $spec and $age years old.";
	}

}

// Создание экземпляра объекта
$person1 = new Person;

$person1->name = 'Peter';
$person1->speciality = 'Programmer';
$person1->age = 25;

// Обращение к свойству объекта
// $ пишем только вначале
// echo $person1->name . "<br>";
// echo $person1->speciality . "<br>";
// echo $person1->age . "<br>";

$person1->greeting($person1->name, $person1->speciality, $person1->age);

?>