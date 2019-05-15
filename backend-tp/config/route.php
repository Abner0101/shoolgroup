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
Route::post('editTable','home/Table/editTable');//编辑加入社团表信息
Route::get('delTable','home/Table/delTable');//删除、退出社团
Route::get('getTable','home/index/getTablebyId');//获取申请表信息
Route::get('getAllTable','home/index/getAlltable');//获取申请表列表

Route::post('addLike','home/Like/addLike');//感兴趣
Route::get('delLike','home/Like/delLike');//不感兴趣
Route::get('getLike','home/index/getLikebyId');
Route::get('getAllLike','home/index/getAllLike');

Route::post('addComment','home/Comment/addComment');//添加评论
Route::get('delComment','home/Comment/delComment');//删除评论
Route::get('getComment','home/index/getCommentbyId');//获取评论
Route::get('getAllComment','home/index/getAllComment');//获取评论列表

Route::post('addOtherComment','home/Othercomment/addOtherComment');
Route::get('delOtherComment','home/Othercomment/delOtherComment');
Route::get('getOtherComment','home/index/getOtherCommentbyId');
Route::get('getAllOtherComment','home/index/getAllOtherComment');


//社团管理后台
Route::post('C_login', 'club/base/login');//社长学号登录

Route::post('addAction','club/action/addAction');//申请活动、
Route::post('editAction','club/action/editAction');//编辑活动
Route::get('delAction','club/action/delAction');//取消活动
Route::get('getAction','club/index/getActionById');//获取活动信息
Route::get('getAllAction','club/index/getAllAction');//获取活动列表

Route::post('C_editTable','club/table/editTable');//编辑加入社团表信息
Route::get('C_delTable','club/table/delTable');//删除、退出社团
Route::post('C_editMember','club/member/editMember');//编辑会员信息

Route::post('addEquip','club/equip/addEquip'); //添加申请
Route::post('editEquip','club/equip/editEquip'); // 编辑申请信息
Route::get('delEquip','club/equip/delEquip'); //删除申请信息
Route::get('getEquip','club/index/getEquipById'); //获取申请信息
Route::get('getAllEquip','club/index/getAllEquip'); //获取申请列表

Route::post('C_editClub','club/club/editClub');//修改社团信息


//超级管理员后台
Route::post('M_login', 'manage/base/login');//超级管理员登录
Route::post('M_editClub','manage/club/editClub');//编辑社团信息
Route::get('M_delClub','manage/club/delClub');//删除社团
Route::post('M_addTable','manage/table/addTable');//增添申请表 
Route::post('M_editMember','manage/member/editMember');//编辑会员信息   
Route::get('M_delMember','manage/member/delMember');//删除会员信息 
Route::post('M_editAction','manage/action/editAction');//编辑活动信息  
Route::get('M_delAction','manage/action/delAction');    
Route::post('M_editEquip','manage/equip/editEquip');
Route::get('M_delEquip','manage/equip/delEquip');

Route::post('addManager','manage/manager/addManager');
Route::post('editManager','manage/manager/editManager');
Route::get('delManager','manage/manager/delManager');
Route::get('getManager','manage/index/getManagerById');
Route::get('getAllManager','manage/index/getAllManager');    

Route::get('M_delComment','manage/comment/delComment');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      