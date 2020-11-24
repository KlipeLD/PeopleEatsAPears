<?php
main();
function main()
{
	//создаём еду
	$pear = new Pear();
	$raspberry = new Raspberry();
	$strawberry = new Strawberry();
	
	// создаем человека и заставляем его кушать
	$human = new Human();
	$human->username = "Маша";
	$human->eatstart($pear);
		
	//создаём правительство, которое начинает кушать, создавать законы и сажать людей в тюрьмы.
	$admin = new Goverment();
	$admin->username = "Александр Петрович";
	$admin->eatstart($raspberry);
	$admin->createNewLaw( "Из страны уезжать нельзя" ); 
	$admin->banHuman( $human );

	//рандомная клубника

	$admin->eatstart($strawberry);

}

function generator() 
{	
	$property1 = ['съедобную', 'не съедобную'];
	$property2 = ['зелёную', 'зрелую', 'перезрелую', 'гнилую'];
	$allproperty = ['не обычную',...$property2 , ...$property1];
	for ($i = 0; $i <= 2; $i++) 
	{
		yield $allproperty[rand(0,6)];
	}
}

abstract class Food 
{
	public $property = "съедобную";
	abstract public function can_be_eaten();
}

class Strawberry extends Food 
{
	
	public $property = "";
	public function can_be_eaten() 
	{
		$arr = [...generator()];
		$rand_property = array_rand($arr,1);
		
		return " $this->property$arr[$rand_property] клубнику.<br>";
	}
}
class Pear extends Food 
{
	public function can_be_eaten() 
	{
		return " $this->property грушу.<br>";
	}
}
class Raspberry extends Food 
{
	public $property = "незрелую";
	public function can_be_eaten() 
	{
		return " $this->property малину.<br>";
	}
}

class Human {
 
	public $username = "";
	private $eating = false;
	private $sleeping = false;
 
	public function eatstart($food) 
	{
		$this->eating = true;
		$food1 = $food->can_be_eaten();
		echo "$this->username кушает $food1";
		
	}
	public function eatend() 
	{
		$this->eating = false;
		echo "$this->username не кушает";
	}
	public function isEating() 
	{
		return $this->eating;
	}
	public function sleepstart() 
	{
		$this->sleeping = true;
	}
	public function sleepend() 
	{
		$this->sleeping = false;
	}
}
 
class Goverment extends Human 
{
	public function createNewLaw( $lawName ) 
	{
		echo "$this->username создал новый закон: $lawName<br>";
	}
	public function banHuman( $human ) 
	{
		echo "$this->username посадил(а) в тюрьму нового человека: $human->username<br>";
	}
	public function eatstart($food) 
	{
		$this->eating = true;
		$food1 = $food->can_be_eaten();
		echo "$this->username кушает самую дорогую $food1";
	}
}