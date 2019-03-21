<?php

namespace app\home\validate;
use think\Validate;
/**
* 设置模型
*/
class Recruitment extends BaseValidate
{
	protected $rule = array(
		'companyid'  => 'require',
	);
	protected $message = array(
		'companyid.require'		=>'请选择公司',
	);
}