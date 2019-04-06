<?php

namespace app\home\validate;
use think\Validate;
/**
* 设置模型
*/
class Club extends Validate
{
    protected $rule = array(
        'c_name'      => 'require|unique:club',
        'c_createrId' => 'unique:club'
    );
    protected $message = array(
        'c_name.require'          => '社团名称必须填写',
        'c_name.unique'           => '该社团已存在',
        'c_createrId.unique'      => '您已创建社团，不可再创建'
    );
}