<?php

namespace app\manage\validate;
use think\Validate;
/**
* 设置模型
*/
class Table extends Validate
{
    protected $rule = array(
        'role'      => 'require',
        'memberId' => 'unique:table'
    );
    protected $message = array(
        'role.require'          => '申请角色必须填写',
        'memberId.unique'      => '该会员已有社团申请，不可再申请'
    );
}