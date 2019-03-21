<?php
namespace app\home\controller;
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

    //手机验证登录
    public function phonelogin(){
        $userModel = model('Member');
        $param = $this->param;
        $phone = $param['m_phone'];
        $phone_code = $param['code'];
        $result = $userModel->phonelogin($phone, $phone_code);
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

    public function Register(){
        $param = $this->param;
        // return ['error' =>  cache('phone_code')];

        $MemberModel = model('member');
        $result = $MemberModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function relogin(){   
        $userModel = model('User');
        $param = $this->param;
        $data = decrypt($param['rememberKey']);
        $username = $data['username'];
        $password = $data['password'];

        $result = $userModel->login($username, $password, '', true, true);
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

//发送短信验证码
    public function sms(){
        //实现短信验证功能
        $param = $this->param;
        // $phone   = input('post.m_phone','','htmlspecialchars');
        $phone= $param['m_phone'];
        //创蓝
        $api = "http://sms.quweiziyuan.cn/sms.php";
        $random = mt_rand(100000, 999999);

        $data = array(
            'key' => 'wein07699',
            'tell' => "{$phone}",
            'code' => "{$random}"
        );
        cache('phone_code', $random);
        cache('phone', $phone);
        $ret = post($api, $data);
        echo $ret;
    }


}