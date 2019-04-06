<?php
namespace app\manage\controller;
use think\Request;
use app\common\controller\Common;
// use app\home\model\User;

class Base extends Common
{
    //学号登录
    public function login(){
        $userModel = model('Manager');
        $param = $this->param;
        
        $username = $param['username'];
        // return ['error' => $username];
        $password = $param['password'];
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


  



}