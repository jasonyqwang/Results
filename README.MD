# Results 处理结果类的封装

## 安装

    composer require jsyqw/results

## 使用说明

* 一般用于返回统一格式的时候使用（API）
* 使用的模式三种
    

    1.Trait方式引入 ,在 Class 中引入 eg:  use Jsyqw\Ret\Traits\Results
    
    2.对象方式引入 eg: new Jsyqw\Ret\Results()
    
    3.单例引入模式 eg: \Jsyqw\ret\Singleton\Results::instance()->success()
    
   
    
*  返回结果默认格式定义如下  
```php

    //默认返回的消息
    protected static $defaultMsgList = [
        //成功
        0 =>    '操作成功',
        
        //1001 - 1999 客户端引起的错误
        1002 => '非法请求',//（post & get 请求不正确）
        1003 => '参数错误',//具体是什么参数错误，可以在返回的时候输入msg参数
        1004 => '签名无效',//--基类
        1005 => '请求无效',//（时间校验失败）--基类

        //2000 - 2999 服务器的业务交互的错误提示(包括约定好的特殊状态码）
        2000 => '服务器繁忙',    //服务器返回友好提示
        2001 => '未知错误',
        2002 => '没有更多数据了',//（针对列表式加载更多）
        2003 => '暂无数据',//数据不存在
        2004 => '认证错误',//token 无效--基类

        //3001 - 4000 服务器错误（用户自定义的错误，都应该在这个段，比如 try catch 到的异常信息）
        3001 => '服务器处理异常',
    ];

```
* 调用方法
```php
    //1.对象返回成功数据示例
    $result = \Jsyqw\Ret\Results();
    print_r(result->success($data = [], $msg = '', $params = []));
    
    //2.使用 trait特性，一般是使用在已经继承别的类的情况下（常常使用在 ApiController中）
  
    class A{
        use Jsyqw\Ret\Results;
        
        //返回json数组 
        $this->returnJson($array = null, Closure $callback = null);
        
        //返回 
        $this->success($data = [], $msg = '', $params = [], Closure $callback = null);
        
        $this->paramsError($msg = '', $data = [], $params = [], Closure $callback = null);
        
        $this->error($msg = '', $code = 2000, $data = [], $params = [], Closure $callback = null);
        
        $this->authError($params = [], $data = [], Closure $callback = null);
        
        $this->setCode($code);
        
        $this->setMsg($msg = '');
        
        $this->setData($data);
    }
    
    //返回格式： 
    [
        'code' => 0,
        'msg'  => '',
        'data' => [],
        'time' => 0
    ]
    
```
