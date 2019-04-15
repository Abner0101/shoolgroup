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




}