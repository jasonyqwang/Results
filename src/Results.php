<?php
/**
 * 类模式
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Ret;

class Results
{
  use \Jsyqw\Ret\Traits\Results;

  public function a(){
      \Jsyqw\ret\Singleton\Results::instance()->success();
  }
}