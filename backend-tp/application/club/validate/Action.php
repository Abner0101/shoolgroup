<?php

namespace app\club\validate;
use think\Validate;
/**
* 设置模型
*/
class Action extends BaseValidate{

    protected $rule = array(
        'clubid'          => 'require'
        // 'm_phone'           => 'isMobile|unique:member'
    );
    protected $message = array(
        'clubid.require' => '社团id必须包含'
        // 'm_number.unique'       => '该账号已存在',
        // 'm_phone.isMobile'      =>'手机格式输入错误',
        // 'm_phone.unique'        =>'该手机号已注册'
    );
}