<?php
/**
 * 多例模式（Multiton）
 *
 * 目的:
 * 1. 多例模式是指存在一个类有多个相同实例，而且该实例都是该类本身。这个类叫做多例类。 多例模式的特点是：
 *    多例类可以有多个实例。
 * 2. 多例类必须自己创建、管理自己的实例，并向外界提供自己的实例。
 *
 * 多例模式实际上就是单例模式的推广。
 *
 * 举例
 *
 * 2 个数据库连接器，比如一个是 MySQL ，另一个是 SQLite
 * 多个记录器（一个用于记录调试消息，一个用于记录错误）
 */

final class Multiton
{
    const INSTANCE1 = '1';
    const INSTANCE2 = '2';

    /**
     * @var array 实例数组
     */
    private static $instances = [];

    /**
     * 这里私有方法阻止用户随意的创建该对象实例
     *
     * Multiton constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance(string $instanceName)
    {
        if (!isset(self::$instances[$instanceName])) {
            self::$instances[$instanceName] = new self();
        }
        return self::$instances[$instanceName];
    }

    /**
     * 该私有对象阻止实例被克隆
     */
    private function __clone()
    {
    }
}

$a = Multiton::getInstance('1');
$b = Multiton::getInstance('1');
$c = Multiton::getInstance('2');
$d = Multiton::getInstance('2');

// test
var_dump($a === $b);
var_dump($c === $d);
