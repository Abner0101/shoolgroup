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
Route::get('relogin', 'home/base/relogin');
Route::get('logout', 'home/base/logout');



//前台
Route::post('login', 'home/base/login');//会员学号登录
Route::post('phonelogin','home/base/phonelogin');//手机号登录
Route::post('register','home/Base/Register');//注册
Route::post('editMember','home/member/editMember');//编辑会员信息
Route::get('delMember','home/member/delMember');//删除会员
Route::get('getMember','home/index/getMemberById');//获取会员信息
Route::get('getAllMember','home/index/getAllMember');//获取会员列表
Route::post('getSms','home/Base/sms');//获取验证码

Route::post('addClub','home/Club/addClub'); //创建社团
Route::post('editClub','home/Club/editClub'); //编辑社团信息
Route::get('getClub','home/index/getClubbyId');  //获取社团信息
Route::get('delClub','home/Club/delClub'); //删除社团信息
Route::get('getAllClub','home/index/getAllclub'); //获取社团列表

Route::post('joinClub','home/Table/addTable');//申请加入社团
Route::post('editTable','home/Table/editTable');//编辑社团信息
Route::get('delTable','home/Table/delTable');//删除、退出社团
Route::get('getTable','home/index/getTablebyId');//获取申请表信息
Route::get('getAllTable','home/index/getAlltable');//获取申请表列表


//社团管理后台
Route::post('C_login', 'club/base/login');//社长学号登录
Route::post('addAction','club/action/addAction');//申请活动、
Route::post('editAction','club/action/editAction');//编辑活动
Route::get('delAction','club/action/delAction');//取消活动
Route::get('getAction','club/index/getActionById');//获取活动信息
Route::get('getAllAction','club/index/getAllAction');//获取活动列表


//超级管理员后台
Route::post('M_login', 'manage/base/login');//社长学号登录
Route::post('M_editClub','manage/club/editClub');//编辑社团信息
Route::get('M_delClub','manage/club/delClub');//删除社团
Route::post('M_addTable','manage/table/addTable');//增添申请表 
Route::post('M_editMember','manage/member/editMember');//编辑会员信息    
Route::post('M_editAction','manage/action/editAction');//编辑活动信息  
Route::get('M_delAction','manage/action/delAction');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              