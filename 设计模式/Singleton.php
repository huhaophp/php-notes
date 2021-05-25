<?php

// 目的:
// 在应用程序调用的时候，只能获得一个对象实例。

// 例子:
// 1.数据库连接
// 2.日志 (多种不同用途的日志也可能会成为多例模式)
// 3.在应用中锁定文件 (系统中只存在一个 ...)

/**
 * Class Singleton
 *
 * final class 则不能被继承。
 */
final class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance;

    /**
     * 通过懒加载获得实例（在第一次使用的时候创建）
     */
    public static function getInstance(): Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 不允许从外部调用以防止创建多个实例
     * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    private function __construct()
    {
    }

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {
    }

    /**
     * 防止反序列化（这将创建它的副本）
     */
    private function __wakeup()
    {
    }
}

$instance1 = Singleton::getInstance();
$instance2 = Singleton::getInstance();

var_dump($instance1 === $instance2);
