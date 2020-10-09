<?php

/**
 * 当在指定对象上调用一个不存在的成员方法时，如果该对象包含 __call 魔术方法，则尝试调用该方法作为兜底
 * 与之类似的，当在指定类上调用一个不存在的静态方法，如果该类包含 __callStatic 方法，则尝试调用该方法作为兜底
 */
class Car
{
    public function __call($name, $arguments)
    {
        echo '调用的成员方法不存在' . PHP_EOL;
    }

    public static function __callStatic($name, $arguments)
    {
        echo '调用的静态方法不存在' . PHP_EOL;
    }
}

(new Car())->driver();
Car::driver();

/**
 * __set()、__get()、__isset() 和 __unset()
 * __set() 方法会在给不可访问属性赋值时调用
 * __get() 方法会在读取不可访问属性值时调用
 * 不可访问有两层意思，一层是属性的可见性不是 public，另一层是对应属性压根不存在
 * 当对不可访问属性调用 isset() 或 empty() 时，__isset() 会被调用
 * 当对不可访问属性调用 unset() 时，__unset() 会被调用
 * 过，对于不可见属性，还是推荐使用存取器（Setters/Getters）来操作，避免引入额外的存储空间。
 */

/**
 * __invoke 魔术方法会在以函数方式调用对象时执行
 */
class Test
{
    protected $brand;

    public function __invoke($brand)
    {
        $this->brand = $brand;
        echo '蓝天白云，定会如约而至 -- ' . $this->brand . PHP_EOL;
    }
}

$test = new Test();
$test('宝马');