<?php
namespace app\club\controller;
use think\Request;
use app\common\controller\Common;
// use app\home\model\User;

class Base extends Common
{
    //学号登录
    public function login(){
        $userModel = model('Member');
        $param = $this->param;
        // dump($param);die;
        $username = $param['m_number'];
        $password = $param['m_password'];
        $verifyCode = !empty($param['verifyCode'])? $param['verifyCode']: '';
        $isRemember = !empty($param['isRemember'])? $param['isRemember']: '';
        $result = $userModel->login($username, $password, $verifyCode, $isRemember);
        if(isset($param['callback']))
        	if (!$result)
        		return resultJsonp(['error' => $userModel->getError()]);
        	else
                return resultJsonp(['data' => $result]);
        else
        	if (!$result)
	            return resultArray(['error' => $userModel->getError()]);
	        else
            	return resultArray(['data' => $result]);
    }


  

    public function logout(){
        /*获取头部信息*/ 
        $header = Request::instance()->header();
        $authKey = $header['authkey'];
        $sessionId = $header['sessionid'];
        $cache = cache('Auth_'.$authKey);
        if(empty($authKey) || empty($cache)){
            if(isset($param['callback']))
                return resultJsonp(['error'=>'参数有误，退出失败']);
            else
                return resultArray(['error'=>'参数有误，退出失败']);
        }else{
            if($cache['sessionId'] == $sessionId){
                cache('Auth_'.$authKey, null);
                if(isset($param['callback']))
                    return resultJsonp(['data' => '退出成功']);
                else
                    return resultArray(['data'=> '退出成功']);
            }else{
                if(isset($param['callback']))
                    return resultJsonp(['error'=>'非法操作，退出失败']);
                else
                    return resultArray(['error'=>'非法操作，退出失败']);
            }
        }
    }




}