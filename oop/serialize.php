<?php

/**
 * PHP 支持通过 serialize() 函数将对象序列化为字符串保存下来，然后在需要的时候再通过 unserialize() 函数将对应字符串反序列化为对象
 * __sleep() 和 __wakeup() 是一组相对的魔术方法，__sleep() 如果在类中存在的话，会在序列化方法 serialize 执行之前调用，以便在序列化之前对对象进行清理工作
 * 相对的，__wakeup() 如果在类中存在的话，会在反序列化方法 unserialize() 执行之前调用，以便准备必要的对象资源
 */
class Car
{
    protected $brand;

    private $no;

    protected static $WHEELS = 4;

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * 注意，在 __sleep 方法中需要返回一个包含所有要返回对象属性的数组
     * 不能包含静态属性
     */
    public function __sleep()
    {
        return ['brand', 'no'];
    }

    /**
     * 我们为 Car 类新增一个私有属性 $no，并在其中定义 __sleep() 和 __wakeup() 方法来设置 $no 属性值
     */
    public function __wakeup()
    {
        $this->no = 10001;
    }
}

$car = new Car();
$car->setBrand('领克01');

// 将对象序列化后保存到文件
$string = serialize($car);
file_put_contents('car', $string);

// 从文件读取对象字符串反序列化为对象
$content = file_get_contents('car');
$object  = unserialize($content);
echo '汽车品牌: ' . $object->getbrand() . PHP_EOL;
echo '汽车号码: ' . $object->getNo() . PHP_EOL;