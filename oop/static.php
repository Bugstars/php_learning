<?php

/**
 * Class Car
 * PHP 类属性和方法都要在类实例化后才能调用（常量属性除外）
 * 除此之外，PHP 还提供了静态属性和静态方法，所谓「静态」指的是无需对类进行实例化，就可以直接调用这些属性和方法
 * 如果是在类内部方法中，需要通过 self:: 引用当前类的静态属性和方法，就像常量一样
 * 因为静态属性和方法无需实例化类即可使用，而没有实例化的情况下，$this 指针指向的是空对象，所以不能动过它引用静态属性和方法
 */
class Car
{
    public static $WHEELS = 4;

    public static function getWheels()
    {
        return self::$WHEELS;
    }
}

echo 'WHEELS: ' . Car::$WHEELS . PHP_EOL;
echo 'getWheels: ' . Car::getWheels() . PHP_EOL;

/**
 * 静态属性支持动态修改
 */

Car::$WHEELS = 8;
echo 'WHEELS:' . Car::$WHEELS . PHP_EOL;
