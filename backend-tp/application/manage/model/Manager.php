<?php
namespace app\manage\model;
use app\manage\model\Common;
use traits\model\SoftDelete;
class Manager extends Common
{
    use SoftDelete;
    protected $insert = [
        'status' => 1,
    ];
    protected $deleteTime = 'delete_time';
    protected $hidden = ['password'];
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $autoWriteTimestamp = true;

    /**
     * [login 登录]
     * @AuthorHTL
     * @DateTime  2017-02-10T22:37:49+0800
     * @param     [string]                   $u_username [账号]
     * @param     [string]                   $u_pwd      [密码]
     * @param     [string]                   $verifyCode [验证码]
     * @param     Boolean                    $isRemember [是否记住密码]
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
        //      $this->error = '验证码不能为空';
        //      return false;
        //     }
        //     $captcha = new HonrayVerify(config('captcha'));
        //     if (!$captcha->check($verifyCode)) {
        //      $this->error = '验证码错误';
        //      return false;
        //     }
        // }
        $map['username'] = $username;
        $userInfo = $this->where($map)->find();
        if (!$userInfo) {
            $this->error = '帐号不存在';
            return false;
        }
        if (user_md5($password) !== $userInfo['password']) {
            $this->error = '密码错误';
            return false;
        }
        if ($userInfo['status'] === 0) {
            $this->error = '帐号已被禁用';
            return false;
        }

        if ($isRemember || $type) {
            $secret['username'] = $username;
            $secret['password'] = $password;
            $data['rememberKey'] = encrypt($secret);
        }
        // 保存缓存        
        session_start();
        $info['userInfo'] = $userInfo;
        $info['sessionId'] = user_md5($userInfo['username']);
        $authKey = user_md5($userInfo['username'].$userInfo['password'].$info['sessionId']);
        $info['authKey'] = $authKey;
        cache('Manage_'.$authKey, null);
        cache('Manage_'.$authKey, $info);
        // 返回信息
        $data['m_authKey']        = $authKey;
        $data['m_sessionId']      = $info['sessionId'];
        $data['userInfo']         = $userInfo;
        return $data;
    }

    public function createData($param){
        if(!is_null($param['password'])){
            $param['password'] = user_md5($param['password']);
            $param['status']=1;
        }
        return parent::createData($param);
    }

    public function editData($param, $id){
        if(!is_null($param['password'])){
            $param['password'] = user_md5($param['password']);
        }
        return parent::editData($param, $id);
    }

    public function delData($param){
        return parent::delDataTrue($param);
    }

    public function getDataById($param){
        return parent::getDataById($param);
    }

    public function getAllDatas(){
        return parent::getAllDatas();
    }

}