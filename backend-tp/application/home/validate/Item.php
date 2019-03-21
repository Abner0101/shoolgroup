<?php

namespace app\home\validate;
use think\Validate;
/**
* 设置模型
*/
class Item extends BaseValidate
{
	protected $rule = array(
		'name'      => 'require',
		'cate_id'	=>	'require|isPositiveInteger',
		'url'      => 'require',
	);
	protected $message = array(
		'name.require'    		=> '标题必须填写',
		'cate_id.require'    		=> 'cate_id必须填写',
		'cate_id.isPositiveInteger' => 'cate_id必须是正整数',
		'url.require'    		=> '链接必须填写',
	);
}