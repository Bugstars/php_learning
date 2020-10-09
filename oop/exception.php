<?php
/**
 * 捕获异常
 * 和错误捕获一样，我们可以 try...catch... 语句块捕获异常
 */

/**
 * @param $book
 * @param $key
 * @return mixed
 */
function getItemFromBook($book, $key)
{
    if (empty($book) || !key_exists($key, $book)) {
        throw new InvalidArgumentException('数组为空或对应索引不存在！');
    }
    return $book[$key];
}

$book = [
    'title' => '这是本好书',
    'summary' => '非常好，看了还想看',
    'author' => '任盼',
    'price' => 199,
    'website' => 'https://renpan.book',
    'create_at' => '2020',
];

// 试图从 $book 数组中访问一个不存在的索引，此时没有定义任何异常捕获和处理逻辑，所以会以错误报告方式进行兜底处理
// var_dump(getItemFromBook($book, 'desc'));

try {
    $val = getItemFromBook($book, 'desc');
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
    exit();
}

var_dump($val);

/**
 * 如果不知道抛出的异常类型是什么，可以通过 Exception 基类捕获（或者其他父级异常类）
 * 也就是说，此处也符合父子类型的转化逻辑，但是如果不是 InvalidArgumentException 或者其父类，就不能捕获了
 * 在进行系统框架设计时，考虑到系统的稳健型，总会有一些异常的「漏网之鱼」没有被捕获和处理
 * 这个时候就要通过 set_exception_handler 函数注册全局的异常处理器来处理这些未被捕获和处理的异常
 */

/**
 * 自定义异常类
 * 上面所有的异常都是 PHP 内置的异常类，除此之外，可以根据需要创建自定义的异常类，只需要继承自 Exception 基类或者其子类即可
 * 比如我们为索引不存在定义一个独立的异常类，并且继承自 LogicException 父类
 */
class IndexNotExistsException extends LogicException
{
    // 需要注意的是，Exception 类中的很多方法定义前面都有一个 final 关键字，通过该关键字修饰的方法不能被子类重写

    final public function getMsg()
    {
        echo '声明了一个新的方法';
    }
}