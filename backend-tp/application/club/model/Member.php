<?php
namespace app\club\model;
use app\club\model\Common;
use traits\model\SoftDelete;
class Member extends Common
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';
    protected $hidden = ['m_password'];
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
    
    public function createData($param){
        // dump($param);die;
        if($_FILES){
            $file = request()->file('m_img');
            // 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                $img_src = '/uploads/'.$info->getSaveName();
                $img_src = str_replace('\\','/',$img_src);
                $param['m_img'] = $img_src;
            }else{
                // 上传失败获取错误信息
                return ['code'=>0,'msg'=>$file->getError()];
            }
        }else{
            $param['m_img'] ="/uploads/img/moren.jpg";
        }
        if(!is_null($param['m_password'])){
            $param['m_password'] = user_md5($param['m_password']);
            $param['status']=1;
        }
        if($param['code']!=cache('phone_code')){
            return ['error' => '手机验证码错误'];
        }
        if ($param['m_phone']!=cache('phone')) {
            return ['error' => '发送信息的手机与注册手机不一致'];
        }
        return parent::createData($param);
    }

    public function editData($param, $id){
        // if(!is_null($param['m_img']))
        // {
            if($_FILES){
                $file = request()->file('m_img');
                // 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

                if($info){
                    $img_src = '/uploads/'.$info->getSaveName();
                    $img_src = str_replace('\\','/',$img_src);
                    $param['m_img'] = $img_src;
                }else{
                    // 上传失败获取错误信息
                    return ['code'=>0,'msg'=>$file->getError()];
                }
            }
        // }
        
        if( !is_null($param['m_password']))
            $param['m_password'] = user_md5($param['m_password']);

        if( !is_null($param['code'])){
            if($param['code']!=cache('phone_code')){
                return ['error' => '手机验证码错误'];
            }
            if ($param['m_phone']!=cache('phone')) {
                return ['error' => '发送信息的手机与注册手机不一致'];
            }
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
        if($userInfo['clue_right'] != 1){
            $this->error = '该账号没有登录权限';
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
        $info['sessionId'] = user_md5($userInfo['id']);
        $authKey = user_md5($userInfo['m_number'].$userInfo['m_password'].$userInfo['m_name'].$info['sessionId']);
        $info['authKey'] = $authKey;
        cache('Club_'.$authKey, null);
        cache('Club_'.$authKey, $info);
        // 返回信息
        $data['c_authKey']        = $authKey;
        $data['c_sessionId']      = $info['sessionId'];
        $data['userInfo']         = $userInfo;
        return $data;
    }

   
    
}