<?php

// 简单工厂模式（Simple Factory）

// 工厂模式，就是负责生成其他对象的类或方法。

interface Car
{
    public function drive();
}

/**
 * 宝马汽车
 *
 * Class BwCar
 */
class BwCar implements Car
{
    public function drive()
    {
        echo '宝马驾驶' . PHP_EOL;
    }
}

/**
 * 大众汽车
 *
 * Class DzCar
 */
class DzCar implements Car
{
    public function drive()
    {
        echo '大众驾驶' . PHP_EOL;
    }
}

/**
 * Class CarFactory
 */
class CarFactory
{
    public static function make(string $carName)
    {
        $className = ucfirst($carName);
        if (!$className || !class_exists($className)) {
            throw new InvalidArgumentException(sprintf('Invalid class name {%s}', $className));
        }

        return new $className();
    }
}

// Test
CarFactory::make('DzCar')->drive();
CarFactory::make('BwCar')->drive();
CarFactory::make('BwCar1')->drive();

// QA:
// Q: 可能你会存在疑问，使用 new 去实现类不是更加的简单，在业务里面每次new以下。
// A: 如果你多处地方都用了new,那有一天命名需要改动的时候是不是得搜索每一行代码去改，而工厂避免了这种情况
