<?php
/**
 * __clone() 与对象复制
 * 对象复制，与基本类型和数组不同，PHP 对象默认情况下通过引用传递（前者是值传递）
 * 因此，当我们将一个对象 A 赋值给另一个对象 B 时，B 的属性值修改会同步到对象 A
 * 我们通过 PHP 内置的标准类 stdClass（有点类似 Java 中的 Object 类，是一个预置的空实现类，可以在上面设置任意属性） 来演示
 */
$carA = new stdClass();
$carA->brand = '奔驰';
$carA->power = '汽油';

/**
 * 对 $carB 属性值的修改会污染 $carA 的属性值，这是 PHP 新手在循环代码中做对象赋值时经常会犯的错误
 * 而且迭代次数多了之后不易察觉，要避免这个问题，可以借助 clone 关键字拷贝一个全新的对象来实现
 */
//$carB = $carA;
$carB = clone $carA;
$carB->brand = '宝马';


var_dump($carA);
var_dump($carB);

/**
 * 我们把引用赋值和 clone 拷贝统统称之为「浅拷贝」，只有嵌套的对象属性也不相互污染的拷贝才是真正相互对立的「深拷贝」
 * 要实现这种深拷贝，就要用到我们前面提到的 __clone 魔术方法
 */

class Engine
{
    public $num = 4;
}

class Car
{
    public $brand;
    public $power;
    /**
     * @var Engine
     */
    public $engine;

    public function __clone()
    {
        $this->engine = clone $this->engine;
    }
}

$benz = new Car();
$benz->brand = '奔驰';
$benz->power = '汽油';
$engine = new Engine();
$benz->engine = $engine;

$lnykco02 = clone $benz;
$lnykco02->brand = '领克02';
$lnykco02->power = '电池';
$lnykco02->engine->num = 3;

var_dump($benz);
var_dump($lnykco02);



