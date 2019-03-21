<?php
// +----------------------------------------------------------------------
// | Description: 用户
// +----------------------------------------------------------------------
// | Author: hejw
// +----------------------------------------------------------------------

namespace app\home\model;
use app\home\model\Common;
// use think\Db;

class User extends Common
{
	protected $hidden = ['m_password'];
	protected $createTime = 'create_time';
    protected $updateTime = false;
	protected $autoWriteTimestamp = true;
	protected $insert = [
		'status' => 1,
	];

	/**
	 * [login 登录]
	 * @AuthorHTL
	 * @DateTime  2017-02-10T22:37:49+0800
	 * @param     [string]                   $u_username [账号]
	 * @param     [string]                   $u_pwd      [密码]
	 * @param     [string]                   $verifyCode [验证码]
	 * @param     Boolean                  	 $isRemember [是否记住密码]
	 * @param     Boolean                    $type       [是否重复登录]
	 * @return    [type]                               [description]
	 */
	public function login($username, $password, $verifyCode = '', $isRemember = false, $type = false){
        // dump($username);die;
        if (!$username) {
			$this->error = '帐号不能为空';
			return false;
		}
		if (!$password){
			$this->error = '密码不能为空';
			return false;
		}
		// if (config('IDENTIFYING_CODE') && !$type) {
		//     if (!$verifyCode) {
		// 		$this->error = '验证码不能为空';
		// 		return false;
		//     }
		//     $captcha = new HonrayVerify(config('captcha'));
		//     if (!$captcha->check($verifyCode)) {
		// 		$this->error = '验证码错误';
		// 		return false;
		//     }
		// }
		$map['m_number'] = $username;
		$userInfo = $this->where($map)->find();
    	if (!$userInfo) {
			$this->error = '帐号不存在';
			return false;
    	}
    	if (user_md5($password) !== $userInfo['m_password']) {
			$this->error = '密码错误';
			return false;
    	}
    	if ($userInfo['status'] === 0) {
			$this->error = '帐号已被禁用';
			return false;
    	}
        if ($isRemember || $type) {
        	$secret['m_number'] = $username;
        	$secret['m_password'] = $password;
        	$data['rememberKey'] = encrypt($secret);
        }
        // 保存缓存        
        session_start();
        $info['userInfo'] = $userInfo;
        $info['sessionId'] = session_id();
        $authKey = user_md5($userInfo['m_number'].$userInfo['m_password'].$info['sessionId']);
        $info['authKey'] = $authKey;
        cache('Auth_'.$authKey, null);
        cache('Auth_'.$authKey, $info);
        // 返回信息
        $data['authKey']		= $authKey;
        $data['sessionId']		= $info['sessionId'];
        $data['userInfo']		= $userInfo;
        return $data;
    }
    public function editData($param, $id){
    	if(!is_null($param['password']))
    		$param['password'] = user_md5($param['password']);
		return parent::editData($param, $id);
	}
	public function createData($param){
		if(!is_null($param['password']))
    		$param['password'] = user_md5($param['password']);
		return parent::createData($param);
	}
	public function getAllDatas(){
		return parent::getAllDatas();
	}
	public function getDataById($param){
		return parent::getDataById($param);
	}
	public function delData($param){
		return parent::delData($param);
	}
}