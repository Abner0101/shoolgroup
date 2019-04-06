<?php

namespace app\manage\validate;
use think\Validate;
/**
* 设置模型
*/
class Action extends BaseValidate{

    protected $rule = array(
        'id'          => 'require'
        // 'm_phone'           => 'isMobile|unique:member'
    );
    protected $message = array(
        'id.require' => '活动id必须包含'
        // 'm_number.unique'       => '该账号已存在',
        // 'm_phone.isMobile'      =>'手机格式输入错误',
        // 'm_phone.unique'        =>'该手机号已注册'
    );
}