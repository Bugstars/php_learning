<?php

/**
 * Interface CarContract
 * 通过对象组合水平扩展PHP类功能
 */
//interface CarContract
//{
//    public function driver();
//    public function power(Gas $gas);
//}
//
//abstract class BaseCar implements CarContract
//{
//    public function __construct($brand)
//    {
//        $this->brand = $brand;
//    }
//
//    abstract public function driver();
//    abstract public function power(Gas $gas);
//}
//
//class LynkCo01 extends BaseCar
//{
//    public function __construct()
//    {
//        $this->brand = '领克01';
//        parent::__construct($this->brand);
//    }
//
//    public function driver()
//    {
//        echo "启动{$this->brand}汽车" .PHP_EOL;
//    }
//
//    public function power(Gas $gas)
//    {
//        echo '动力来源: ' . $gas . PHP_EOL;
//    }
//}
//
//class Gas
//{
//    public function __toString()
//    {
//        return '汽油';
//    }
//}
//
//$lynkco = new LynkCo01();
//$gas = new Gas();
//$lynkco->power($gas);

/**
 * Interface power
 * 汽车的动力接口
 *在类的构造函数参数中声明对 Power 接口实现类的依赖从而完成对象组合
 */
interface Power
{
    public function power();
}

class Gas implements Power
{
    public function power()
    {
        return '汽油';
    }
}

class Battery implements Power
{
    public function power()
    {
        return '电池';
    }
}

/**
 * Interface CarContract
 * 汽车（契约）接口
 */
interface CarContract
{
    // 开车方法
    public function driver();
}



abstract class BaseCar implements CarContract
{
    protected $power;
    protected $brand;

    public function __construct(Power $power, $brand)
    {
        $this->power = $power;
        $this->brand = $brand;
    }

    abstract public function driver();
}

class LynkCo01 extends BaseCar
{
    public function __construct(Power $power)
    {
        parent::__construct($power, '领克01');
    }

    public function driver()
    {
        echo "启动{$this->brand}汽车" . PHP_EOL;
        echo "动力来源: " . $this->power->power() . PHP_EOL;
    }
}

$lynkco = new LynkCo01(new Battery());
$lynkco->driver();
echo "电力不足，自动切换为使用汽油作为动力来源..." . PHP_EOL;
$lynkco = new LynkCo01(new Gas());
$lynkco->driver();


