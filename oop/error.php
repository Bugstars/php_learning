<?php

//error_reporting(E_ALL); // 报告所有错误（默认配置）

// 试图访问一个不存在的 URL 链接或者除数为 0，会抛出 E_WARNING 级别的错误

// 此时如果我们排除对 E_WARNING 级别错误的报告，则执行代码不会报错，同时打印函数返回的结果 false
//error_reporting(E_ALL ^ E_WARNING);

/**
 * 还可以通过 set_error_handler 函数指定自定义错误处理器对错误进行处理
 * 自定义处理器通常是个自定义函数，在这个函数中，我们可以自定义不同级别错误的处理逻辑
 */
set_error_handler('myErrorHandler');

$content = file_get_contents('https://www.baidu.com/error');

var_dump($content);

/**
 * 自定义错误处理器
 * @param $errno int 错误级别
 * @param $errstr string 错误信息
 * @param $errfile string 错误文件
 * @param $errline  int   错误行号
 */
//function myErrorHandler($errno, $errstr, $errfile, $errline)
//{
//    // 该级别错误不报告的话退出
//    if (!(error_reporting() & $errno)) {
//        return;
//    }
//
//    switch ($errno) {
//        case E_ERROR:
//            echo "致命错误类型: [$errno] $errstr\n";
//            break;
//        case E_WARNING:
//            echo "警告错误类型: [$errno] $errstr\n";
//            break;
//        case E_NOTICE:
//            echo "一般错误类型: [$errno] $errstr\n";
//            break;
//        default:
//            echo "未知错误类型: [$errno] $errstr\n";
//            break;
//    }
//}

/**
 * 将错误报告写入日志
 * 可以通过 set_error_handler 函数定义一个全局的自定义错误处理机制
 * 另外，错误报告默认输出到标准输出 STDOUT 中了，我们还可以通过 error_log 函数将其输出到指定日志文件
 * 可以看到 STDOUT 中不再输出日志，而是写入到 oop/logs/err.log 文件中
 */
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    $logDir = __DIR__ . DIRECTORY_SEPARATOR . 'logs';
    if (!file_exists($logDir)) {
        mkdir($logDir);
    }
    $logFile = $logDir . DIRECTORY_SEPARATOR . 'err.log';
    switch ($errno) {
        case E_ERROR:
            error_log(" 致命错误: [$errno] $errstr 错误文件: $errfile\n 错误行: $errline\n", 3, $logFile);
            break;
        case E_WARNING:
            error_log(" 警告: [$errno] $errstr 错误文件: $errfile\n 错误行: $errline\n", 3, $logFile);
            break;
        case E_NOTICE:
            error_log(" 通知: [$errno] $errstr 错误文件: $errfile\n 错误行: $errline\n", 3, $logFile);
            break;
        default:
            echo "未知错误类型: [$errno] $errstr 错误文件: $errfile\n 错误行: $errline\n";
            break;
    }
}

/**
 * Error 异常
 * 不同于 PHP 5 的错误报告机制，在 PHP 7 中，大多数错误被作为 Error 异常抛出
 * 这种 Error 异常可以像 Exception 那样被捕获，如果没有对 Error 异常进行捕获，则调用全局异常处理器（通过 set_exception_handler 函数注册）处理
 * 如果全局异常处理器也没有注册，则按照传统错误报告方式处理，就像我们上面演示的那样，如果通过 try/catch 语句捕获
 */

/**
 * 和传统错误报告一样，你可以通过设置 display_errors 选项决定是否向用户显示错误报告和 Error 异常，该配置默认在 PHP 配置文件中全局设置
 * ini_set('display_errors', 0);
 * 该值默认为 1，表示显示用户级错误，设置为 0 则表示不显示用户级错误，可以自行测试下设置与否对错误输出的影响
 * 还有一个与之类似的全局配置 display_startup_errors，表示是否显示 PHP 启动过程中的错误信息，设置逻辑也是一样。建议在线上环境将这两个配置值都设置为 0
 */