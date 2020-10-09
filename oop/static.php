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

/**
 * 我们前面提到不能在静态方法中通过 $this 调用非静态属性/方法，但是在非静态方法中可以通过 self:: 调用静态属性/方法
 */

/**
 * 后期静态绑定（Late Static Bindings）针对的是静态方法的调用，使用该特性时不再通过 self:: 引用静态方法，而是通过 static::，如果是在定义它的类中调用，则指向当前类
 * 此时和 self 功能一样，如果是在子类或者其他类中调用，则指向调用该方法所在的类
 */
//class Car
//{
//
//
//    public static function getClassName()
//    {
//        return __CLASS__;
//    }
//
//    public static function who()
//    {
//        echo static::getClassName() . PHP_EOL;
//    }
//}
//
//class LynkCo01 extends Car
//{
//    public static function getClassName()
//    {
//        return __CLASS__;
//    }
//}
//
//...
//
//Car::who();
//LynkCo01::who();

/**
 * 此外，还可以通过 static::class 来指向当前调用类的类名，例如我们可以通过它来替代 __CLASS__，这样上述子类就没有必要重写 getClassName 方法
 * 代码执行结果和之前的一样
 */
//class Car
//{
//...
//
//    public static function getClassName()
//    {
//        return static::class;
//    }
//
//    public static function who()
//    {
//        echo static::getClassName() . PHP_EOL;
//    }
//}
//
//class LynkCo01 extends Car
//{
//
//}
//
//Car::who();
//LynkCo01::who();
