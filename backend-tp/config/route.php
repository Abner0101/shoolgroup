<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('index', 'home/index/index');
Route::get('getCate', 'home/index/getCateById');
Route::get('getItem', 'home/index/getItemById');

Route::get('relogin', 'home/base/relogin');
Route::get('logout', 'home/base/logout');
Route::post('addCate', 'home/admin/addCate');
Route::post('addItem', 'home/admin/addItem');
Route::post('editCate', 'home/admin/editCate');
Route::post('editItem', 'home/admin/editItem');
Route::get('delItem', 'home/admin/delItem');
Route::get('delCate', 'home/admin/delCate');

Route::get('getUsers', 'home/admin/getAllUsers');
Route::get('getUser', 'home/admin/getUserById');
Route::post('addUser', 'home/admin/addUser');
Route::post('editUser', 'home/admin/editUser');
Route::post('delUser', 'home/admin/delUser');

Route::post('addStaff', 'home/staffcate/addStaff');//添加员工信息
Route::post('editStaff', 'home/staffcate/editStaff');//编辑员工信息
Route::get('delStaff', 'home/staffcate/delStaff');//删除员工信息
Route::get('getStaff', 'home/staffcate/getStaffbyId');//获取员工信息
Route::get('getStaffs', 'home/staffcate/getAllStaff');//获取所有员工信息


Route::post('addRec', 'home/Recruitment/addRec');//添加招聘信息
Route::post('editRec', 'home/Recruitment/editRec');//编辑招聘
Route::get('delRec', 'home/Recruitment/delRec');//删除招聘信息
Route::get('getRec', 'home/index/getRecbyId');//获取招聘信息
Route::get('getRecs', 'home/index/getAllRec');//获取所有招聘信息

Route::post('login', 'home/base/login');//会员学号登录
Route::post('phonelogin','home/base/phonelogin');//手机号登录
Route::post('register','home/Base/Register');//注册
Route::post('editMember','home/member/editMember');//编辑会员信息
Route::get('delMember','home/member/delMember');//删除会员
Route::get('getMember','home/index/getMemberById');//获取会员信息
Route::get('getAllMember','home/index/getAllMember');//获取会员列表
Route::post('getSms','home/Base/sms');//获取验证码

