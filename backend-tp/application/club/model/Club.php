<?php
namespace app\club\model;
use app\club\model\Common;
use traits\model\SoftDelete;
class Club extends Common
{
    use SoftDelete;
    // protected $insert = [
    //     'status' => 1,
    // ];
    // protected $hidden = ['m_password'];
    protected $deleteTime = 'delete_time';
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
        $param['ispass'] = 2;//审核中
        return parent::createData($param);
    }

    public function editData($param, $id){
        // $param['ispass'] = 2;//审核中
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