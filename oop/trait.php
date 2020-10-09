<?php

/**
 * Trait Power
 * 从 PHP 5.4 开始，引入了一种新的代码复用方式 —— Trait，Trait 其实也是一种通过组合水平扩展类功能的机制
 * 我们可以轻松通过 Trait + 类的组合扩展类的功能，在某个类中使用了 Trait 之后，就好像把它的所有代码合并到这个类中一样，可以自由调用
 * 并且同一个 Trait 可以被多个类复用，从而突破 PHP 单继承机制的限制，有效提升代码复用性和扩展性。
 * 一个 Trait 可以被多个不同的类使用，从而实现类功能的水平扩展，同样，一个类也可以使用多个 Trait
 */
trait Power
{
    protected $power;

    protected function gas()
    {
        $this->power = '汽油';
    }

    protected function battery()
    {
        $this->power = '电池';
    }

    /**
     * 同名方法 print() 调用的时候需要用到insteadof来区别
     */
    public function print()
    {
        echo '动力来源: ' . $this->power . PHP_EOL;
    }
}

/**
 * Trait Engine
 * 第二个Trait，可以使用多个Trait
 */
trait Engine
{
    protected $engine;

    protected function three()
    {
        $this->engine = '三缸发动机';
    }

    protected function four()
    {
        $this->engine = '四缸发动机';
    }

    /**
     * 同名方法 print() 调用的时候需要用到insteadof来区别
     */
    public function print()
    {
        echo '发动机: ' . $this->engine . PHP_EOL;
    }
}

class Car
{
    // 引用多个 Trait 通过逗号分隔即可
    // 调用的时候需要用到insteadof来区别同名方法
    // PHP 还提供了别名方案，我们可以通过 as 关键字为同名方法设置不同别名，再通过别名来调用对应方法，不过这种方式还是要先通过 insteadof 解决方法名冲突问题
    use Power, Engine {
        Engine::print insteadof Power;
        Power::print as printPower;
        Engine::print as printEngine;
    }

    public function drive()
    {
        $this->gas();
        $this->four();
        $this->print();
        $this->printPower();
        $this->printEngine();
        echo '汽车启动...' . PHP_EOL;
    }
}

$car = new Car();
$car->drive();

