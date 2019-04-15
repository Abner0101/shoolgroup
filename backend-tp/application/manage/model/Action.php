<?php
namespace app\manage\model;
use app\manage\model\Common;
use traits\model\SoftDelete;
class Action extends Common
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
     public function editData($param, $id){
        // if(!is_null($param['m_img']))
        // {
            if($_FILES){
                $file = request()->file('coverimg');
                // 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

                if($info){
                    $img_src = '/uploads/'.$info->getSaveName();
                    $img_src = str_replace('\\','/',$img_src);
                    $param['coverimg'] = $img_src;
                }else{
                    // 上传失败获取错误信息
                    return ['code'=>0,'msg'=>$file->getError()];
                }
            }
        // }
        
        return parent::editData($param, $id);
    }

    public function delData($param){
        return parent::delDataTrue($param);
    }

}