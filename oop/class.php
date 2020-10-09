<?php

/**
 * Class Car
 */
class Car
{
    const WHEELS = 4;  //汽车都是4个轮子 所以定义常量 不带$
    protected $seats;        // 座位
    protected $door;         // 门
    protected $engine;       // 发动机
    protected $brand;        // 品牌
    private $newCar;

    /**
     * Car constructor.
     * @param $seats
     * @param $door
     * @param $engine
     * @param $brand
     */
    public function __construct($brand, $seats = 5, $door = 4, $engine = 1)
    {
        $this->seats = $seats;
        $this->door = $door;
        $this->engine = $engine;
        $this->brand = $brand;
        $this->newCar = '一辆有' . $this->seats . '个座位和' . $this->door . '扇门和' . $this->engine . '个发动机的' . $this->brand . '牌汽车';
    }

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
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * 开车
     */
    public function drive()
    {
        echo "1.启动引擎..." . PHP_EOL;
        echo "2.挂D档..." . PHP_EOL;
        echo "3.放下手刹..." . PHP_EOL;
        echo "4.踩油门,出发..." . PHP_EOL;
        printf("5.%s已出发" . PHP_EOL, $this->newCar);
    }

    /**
     * 熄火
     */
    public function close()
    {
        echo "1.踩刹车..." . PHP_EOL;
        echo "2.挂P档..." . PHP_EOL;
        echo "3.拉起手刹..." . PHP_EOL;
        echo "4.关闭引擎..." . PHP_EOL;
        printf("5.%s汽车已熄火" . PHP_EOL, $this->newCar);
    }
}

class Benz extends Car
{
    public function __construct($seats = 7, $door = 8, $engine = 2)
    {
        $this->brand = "奔驰";
        parent::__construct($this->brand, $seats, $door, $engine);
    }

    public function drive()
    {
        echo $this->getBrand() . '汽车的启动流程:' .PHP_EOL;
        parent::drive();
    }
}

//// 类属性中的常量不需要实例化，可以直接调用，但不可以修改
//var_dump(Car::WHEELS);
//
//// 类属性中的变量必须实例化才可以调用，可以修改
//$car = new Car();
//$car->seats = 5;
//var_dump($car->seats);
//
//// 如果提供了 Setters/Getters 方法，可以通过这些方法进行设置/获取，从而屏蔽实现细节
//$car->setBrand('奔驰');
//var_dump($car->getBrand());
//
//// 要访问类方法，直接通过对象实例方法名即可
//$car->drive();
//$car->close();

//$car = new Car("奔驰", 13, 31, 14);
//$car->drive();
//$car->close();

// PHP 继承 封装与多态
$benz = new Benz();
$benz->drive();