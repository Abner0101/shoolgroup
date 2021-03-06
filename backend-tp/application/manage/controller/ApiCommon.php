<?php
// +----------------------------------------------------------------------
// | Description: Api基础类，验证权限
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\manage\controller;

use think\Request;
use think\Db;
// use app\common\adapter\AuthAdapter;
use app\common\controller\Common;

class ApiCommon extends Common
{
    public function _initialize(){
        parent::_initialize();
        /*获取头部信息*/ 
        $header = Request::instance()->header();
        
        $authKey = $header['authkey'];
        $sessionId = $header['sessionid'];
        $cache = cache('Manage_'.$authKey);

        // dump($sessionId);die;

        // return ['error' => $sessionId ."+". $cache['sessionId']];
        
        // 校验sessionid和authKey
        if (empty($sessionId)||empty($authKey)||empty($cache)||$sessionId != $cache['sessionId']) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>101, 'error'=>'登录失效']));
        }

        // 检查账号有效性
        $userInfo = $cache['userInfo'];
        $map['id'] = $userInfo['id'];
        $map['status'] = 1;
        if (!Db::name('Manager')->where($map)->value('id')) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>103, 'error'=>'账号已被删除或禁用']));   
        }
        // 更新缓存
        cache('Manage_'.$authKey, $cache);
        // $authAdapter = new AuthAdapter($authKey);
        // $request = Request::instance();
        // $ruleName = $request->module().'-'.$request->controller() .'-'.$request->action(); 
        // if (!$authAdapter->checkLogin($ruleName, $cache['userInfo']['id'])) {
        //     header('Content-Type:application/json; charset=utf-8');
        //     exit(json_encode(['code'=>102,'error'=>'没有权限']));
        // }
        $GLOBALS['userInfo'] = $userInfo;
    }
}
