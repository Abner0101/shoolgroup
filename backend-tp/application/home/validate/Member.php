<?php

namespace app\home\validate;
use think\Validate;
/**
* 设置模型
*/
class Member extends BaseValidate{

    protected $rule = array(
        'm_number'          => 'unique:member',
        'm_phone'           => 'isMobile|unique:member'
    );
    protected $message = array(
        'm_number.unique'       => '该账号已存在',
        'm_phone.isMobile'      =>'手机格式输入错误',
        'm_phone.unique'        =>'该账号已存在'
    );
}