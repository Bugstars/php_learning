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
    protected function gas()
    {
        return '汽油';
    }

    protected function battery()
    {
        return '电池';
    }
}

class Car
{
    use Power;

    public function drive()
    {
        echo '动力来源: ' . $this->gas() . PHP_EOL;
        echo '汽车启动...' . PHP_EOL;
    }
}

$car = new Car();
$car->drive();
