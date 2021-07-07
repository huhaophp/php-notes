<?php

// 状态是一种行为设计模式， 让你能在一个对象的内部状态变化时改变其行为。
// 该模式将与状态相关的行为抽取到独立的状态类中， 让原对象将工作委派给这些类的实例， 而不是自行进行处理。

class Context
{
    /**
     * @var State 对 Context 当前状态的引用.
     */
    private $state;

    public function __construct(State $state)
    {
        $this->transitionTo($state);
    }

    /**
     * Context 允许在运行时更改 State 对象。
     */
    public function transitionTo(State $state): void
    {
        echo "Context: Transition to " . get_class($state) . ".\n";
        $this->state = $state;
        $this->state->setContext($this);
    }

    /**
     * Context 将其部分行为委托给当前的 State 对象。
     */
    public function request1(): void
    {
        $this->state->handle1();
    }

    public function request2(): void
    {
        $this->state->handle2();
    }
}


abstract class State
{
    /**
     * @var Context
     */
    protected $context;

    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    abstract public function handle1(): void;

    abstract public function handle2(): void;
}

class ConcreteStateA extends State
{
    public function handle1(): void
    {
        echo "ConcreteStateA handles request1.\n";
        echo "ConcreteStateA wants to change the state of the context.\n";
        $this->context->transitionTo(new ConcreteStateB());
    }

    public function handle2(): void
    {
        echo "ConcreteStateA handles request2.\n";
    }
}

class ConcreteStateB extends State
{
    public function handle1(): void
    {
        echo "ConcreteStateB handles request1.\n";
    }

    public function handle2(): void
    {
        echo "ConcreteStateB handles request2.\n";
        echo "ConcreteStateB wants to change the state of the context.\n";
        $this->context->transitionTo(new ConcreteStateA());
    }
}

$context = new Context(new ConcreteStateA());
$context->request1();
$context->request2();
