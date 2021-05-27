<?php

/**
 * 策略模式(Strategy Pattern)
 */

/**
 * 策略模式定义了一族相同类型的算法，算法之间独立封装，并且可以互换代替。
 * 这些算法是同一类型问题的多种处理方式，他们具体行为有差别。
 * 每一个算法、或说每一种处理方式称为一个策略。
 * 在应用中，就可以根据环境的不同，选择不同的策略来处理问题
 */

/*
    场景:
    客户端使用微信/支付宝或者其他类型购买，可能我们在业务逻辑当中如下编写代码:

    $payType = $_POST['pay_type'];
    if ($payType == 'wxpay') {
        // wxpay
    } elseif ($payType === 'alpay') {
        // alipay
    } else {
        // other pay
    }
*/

/**
 * 弊端:
 * 如果是一个N种支付场景方案，包括大量的处理逻辑需要封装，或者处理方式变动较大，则就显得混乱。
 * 当需要添加一种算法，就必须修改 if elseif... 逻辑，影响原有代码，可扩展性差。
 * 如果N种支付场景方式很多，if-else或switch-case语句也会很多，代码混乱难以维护。
 */

/**
 * 特点:
 * 策略模式主要用来分离算法，根据相同的行为抽象来做不同的具体策略实现。
 * 策略模式结构清晰明了、使用简单直观。并且耦合度相对而言较低，扩展方便。同时操作封装也更为彻底，数据更为安全。
 * 当然策略模式也有缺点，就是随着策略的增加，子类也会变得繁多。
 */

/**
 * 支付策略接口
 *
 * Interface PayStrategy
 */
interface PayStrategy
{
    public function pay(array $info);
}

class AlipayStrategy implements PayStrategy
{
    public function pay(array $info)
    {
        echo '支付宝支付' . PHP_EOL;
    }
}

class WxPayStrategy implements PayStrategy
{
    public function pay(array $info)
    {
        echo '微信支付' . PHP_EOL;
    }
}

class OtherPayStrategy implements PayStrategy
{
    public function pay(array $info)
    {
        echo '其他支付类型' . PHP_EOL;
    }
}

class PayContext
{
    private $payStrategy;

    public function __construct(PayStrategy $payStrategy)
    {
        $this->payStrategy = $payStrategy;
    }

    public function execute(array $info)
    {
        return $this->payStrategy->pay($info);
    }
}

$info = ['goods_id' => 20000, 'amount' => 1000];

$alipayContext = new PayContext(new AlipayStrategy());
$alipayContext->execute($info);

$wxPayContext = new PayContext(new WxPayStrategy());
$wxPayContext->execute($info);

$otherContext = new PayContext(new OtherPayStrategy());
$otherContext->execute($info);
