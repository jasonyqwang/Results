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
        Codes::CODE_SUCCESS => '操作成功',
        //1000 - 1999 客户端引起的错误
        Codes::CODE_ERROR_INVALID => '非法请求',//（post & get 请求不正确）
        Codes::CODE_ERROR_PARAMS => '参数错误',//各种参数错误，具体是什么参数错误，可以在返回的时候输入msg参数
        Codes::CODE_ERROR_SIGN => '签名无效',//--基类
        Codes::CODE_ERROR_TIME => '请求无效',//（时间校验失败）--基类

        //2000 - 2999 服务器的业务交互的错误提示(包括约定好的特殊状态码）
        Codes::CODE_ERROR_SERVER => '服务器繁忙',    //服务器返回友好提示
        Codes::CODE_ERROR_AUTH => '认证错误',//token 无效--基类【特殊】
        Codes::CODE_ERROR_ACCESS => '没有权限',//没有接口的权限
        Codes::CODE_ERROR_UNKNOWN => '未知错误',

        //3000 - 4000 服务器错误（比如 try catch 到的异常信息，客户端不能直接显示警告）
        Codes::CODE_ERROR_SERVICE => '服务器处理异常',
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
        $this->returnJson(DataModel $dataModel, Closure $callback = null);
        
        //返回 
        $this->success($data = [], $msg = '', $params = [], Closure $callback = null);
        
        $this->paramsError($msg = '', $data = [], $params = [], Closure $callback = null);
        
        $this->error($msg = '', $code = 2000, $data = [], $params = [], Closure $callback = null);
        
        $this->authError($params = [], $data = [], Closure $callback = null);
    }
    
    //返回格式： 
    [
        'code' => 0,
        'msg'  => '',
        'data' => [],
        'time' => 0
    ];
```
