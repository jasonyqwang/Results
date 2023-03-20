<?php
/**
 * 单例模式
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Ret\Singleton;


class Results
{
    use \Jsyqw\Ret\Traits\Results;

    private static $_instance;

    private function __construct()
    {
    }

    /**
     * @return Results
     */
    public static function instance(){

        if(!self::$_instance){
            self::$_instance = new static();
        }

        return self::$_instance;
    }
}