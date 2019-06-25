<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */
require dirname(__DIR__) .'/vendor/autoload.php';

class A {
}

/**
 * B 继承 A，这是如果想让 B 拥有 Results 的所有的方法，则需要使用 traits
 * Class B
 */
class B extends A{
    use \Jsyqw\Ret\Traits\Results;

    public function test1(){
        return $this->success(['name' => 'jason'], '成功', $params = [], $callback = null);
    }

    public function test2(){
        return $this->success(['name' => 'jason'], '成功', $params = [], function (){
            //TODO
            echo '------- hi ------'.PHP_EOL;
        });
    }
}

$b = new B();

print_r($b->test1());
/*
 * 返回结果
    Array
    (
        [code] => 0
        [msg] => 成功
        [data] => Array
            (
                [name] => jason
            )

        [time] => 1561420931
    )
 */


print_r($b->test2());
/*
 * 返回结果
    ------- hi ------
    Array
    (
        [code] => 0
        [msg] => 成功
        [data] => Array
            (
                [name] => jason
            )

        [time] => 1561421650
    )

 */