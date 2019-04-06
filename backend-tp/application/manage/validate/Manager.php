<?php

namespace app\manage\validate;
use think\Validate;
/**
* 设置模型
*/
class Manager extends BaseValidate{

    protected $rule = array(
        'username'          => 'unique:manager',
    );
    protected $message = array(
        'username.unique'       => '该用户名已存在',
    );
}