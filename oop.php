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

	public function __construct($name, $spec, $age) {
		$this->name = $name;
		$this->speciality = $spec;
		$this->age = $age;
	}

	public function greeting() {
		// echo "Hello! My name is $name. I am $spec and $age years old.";
		echo "Hello! My name is " . $this->name . ". I am  " . $this->speciality . " and  " . $this->age . " years old.";
	}

}

// Создание экземпляра объекта
$person1 = new Person('Peter', 'Programmer', 25);
// echo $person1->name;

// $person1->name = 'Peter';
// $person1->speciality = 'Programmer';
// $person1->age = 25;

// Обращение к свойству объекта
// $ пишем только вначале
// echo $person1->name . "<br>";
// echo $person1->speciality . "<br>";
// echo $person1->age . "<br>";

// $person1->greeting($person1->name, $person1->speciality, $person1->age);
$person1->greeting();

echo "<br><br>";

$person2 = new Person('Jane', 'Web-designer', 23);
$person2->greeting();

?>