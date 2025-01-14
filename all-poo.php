<?php

namespace App;

// Enum para estados de los animales
enum AnimalState {
    case ACTIVE;
    case SLEEPING;
    case HUNGRY;
}

// Interfaz
interface AnimalInterface {
    public function makeSound(): string;
    public function move(): string;
    public function eat(string $food): string;
}

// Clase abstracta
abstract class Animal implements AnimalInterface {
    public function __construct(
        protected string $name,
        protected AnimalState $state = AnimalState::ACTIVE
    ) {}

    public function getState(): AnimalState {
        return $this->state;
    }

    public function sleep(): void {
        $this->state = AnimalState::SLEEPING;
    }

    public function wakeUp(): void {
        $this->state = AnimalState::ACTIVE;
    }

    abstract public function makeSound(): string;
    abstract public function move(): string;
    abstract public function eat(string $food): string;
}

// Trait para el registro de actividad
trait Logger {
    public function log(string $message): void {
        echo "[LOG] $message" . PHP_EOL;
    }
}

// Clase concreta Dog
class Dog extends Animal {
    use Logger;

    public function makeSound(): string {
        return "Woof!";
    }

    public function move(): string {
        return "The dog runs around joyfully.";
    }

    public function eat(string $food): string {
        return "The dog devours the $food.";
    }
}

// Clase concreta Cat
class Cat extends Animal {
    public function makeSound(): string {
        return "Meow!";
    }

    public function move(): string {
        return "The cat walks gracefully.";
    }

    public function eat(string $food): string {
        return "The cat nibbles on the $food.";
    }
}

// Clase concreta Bird
class Bird extends Animal {
    public function makeSound(): string {
        return "Tweet!";
    }

    public function move(): string {
        return "The bird flies high in the sky.";
    }

    public function eat(string $food): string {
        return "The bird pecks at the $food.";
    }
}

// Clase para administrar animales
class Zoo {
    private array $animals = [];

    public function addAnimal(Animal $animal): void {
        $this->animals[] = $animal;
    }

    public function makeAllAnimalsSound(): void {
        foreach ($this->animals as $animal) {
            echo $animal->makeSound() . PHP_EOL;
        }
    }
}

// Ejemplo de uso
$dog = new Dog(name: "Buddy");
$cat = new Cat(name: "Whiskers");
$bird = new Bird(name: "Tweety");

$zoo = new Zoo();
$zoo->addAnimal($dog);
$zoo->addAnimal($cat);
$zoo->addAnimal($bird);

$zoo->makeAllAnimalsSound(); // Outputs all animal sounds

$dog->log("The dog is barking loudly.");
