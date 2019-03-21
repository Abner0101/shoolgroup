<?php

namespace app\home\validate;
use think\Validate;
/**
* 设置模型
*/
class Staff extends BaseValidate
{
	protected $rule = array(
		'name'      => 'require',
		'company'      => 'require',
		'position'      => 'require',
		'major'      => 'require',
		'school'      => 'require',
		'keyword'      => 'require|max:16',
		'jointime'      => 'require',
		'itemgroup'      => 'require',
		'education'      => 'require',
		'phone'      => 'require|isMobile',
	);
	protected $message = array(
		'name.require'    		    => '必须填写姓名',
		'company.require'    		=> '必须填写公司名称',
		'position.require'    		=> '必须填写职位',
		'school.require'    		=> '必须填写毕业学校',
		'major.require'    		    => '必须填写专业',
		'keyword.require'    		=> '必须填写关键词',
		'keyword.max'    		    => '关键词长度不能超过16字段',
		'jointime.require'    		=> '必须填写入职时间',
		'itemgroup.require'    		=> '必须填写项目小组',
		'phone.require'    		    => '必须填写联系方式',
		'phone.isMobile'    		=> '请输入正确的手机号码',
		'education.require'    		=> '必须填写学历',

	);
}