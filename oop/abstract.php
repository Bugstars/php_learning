<?php

/**
 * Class Cars
 * 抽象类指的是包含抽象方法的类，而抽象方法是通过 abstract 关键字修饰的方法，抽象方法只是一个方法声明，不能有具体实现
 * 只要某个类包含了至少一个抽象方法，它就是抽象类，抽象类也需要通过 abstract 关键字修饰
 * 如果没有通过 abstract 关键字修饰，会报错
 * 抽象类本身不能被实例化，只能被子类继承，继承了抽象类的子类必须实现父类中的抽象方法，否则会报错
 */
abstract class Car
{
    abstract public function driver();
}

class BWM extends Car
{
    public function driver()
    {
        // TODO: Implement driver() method.
        echo 'abstract hello world!';
    }
}

$bwm = new BWM();
$bwm->driver();
