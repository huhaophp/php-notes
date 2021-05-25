<?php
// 抽象工厂模式（Abstract Factory）

// 目的:
// 在不指定具体类的情况下创建一系列相关或依赖对象。
// 通常创建的类都实现相同的接口。 抽象工厂的客户并不关心这些对象是如何创建的，它只是知道它们是如何一起运行的。

interface Animal
{
    public function say(): string;
}

class Doge implements Animal
{
    private $wow;

    public function __construct(string $wow)
    {
        $this->wow = $wow;
    }

    public function say(): string
    {
        return $this->wow;
    }
}

class Sheep implements Animal
{
    private $wow;

    public function __construct(string $wow)
    {
        $this->wow = $wow;
    }

    public function say(): string
    {
        return $this->wow;
    }
}

class AnimalFactory
{
    public function createDogAnimal(string $wow): Doge
    {
        return new Doge($wow);
    }

    public function createSheepAnimal(string $wow): Sheep
    {
        return new Sheep($wow);
    }
}

$factory = new AnimalFactory();
var_dump($factory->createDogAnimal('汪')->say());
var_dump($factory->createSheepAnimal('咩')->say());
