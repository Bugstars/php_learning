<?php

/**
 * Interface CarContract
 * 和抽象类的抽象方法一样，实现了某个接口的类必须实现接口声明的所有方法，否则会报错
 * 另外，标识一个类实现某个接口通过关键字 implements 完成
 */
interface CarContract
{
    public function driver();
}

abstract class BaseCar implements CarContract
{
    protected $brand;

    /**
     * BaseCar constructor.
     * @param $brand
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    // 将接口声明为抽象方法，让子类去实现
    abstract public function driver();
}

class LynkCo extends BaseCar
{

    public function __construct()
    {
        $this->brand = '领克01';
        parent::__construct($this->brand);
    }

    public function driver()
    {
        echo "启动{$this->brand}汽车" . PHP_EOL;
    }
}
$car = new LynkCo("领克01");
$car->driver();