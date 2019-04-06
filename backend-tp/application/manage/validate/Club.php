<?php

namespace app\manage\validate;
use think\Validate;
/**
* 设置模型
*/
class Club extends Validate
{
    protected $rule = array(
        'c_name'      => 'unique:club',
    );
    protected $message = array(
        'c_name.unique'           => '该社团已存在'
    );
}