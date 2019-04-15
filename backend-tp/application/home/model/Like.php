<?php
namespace app\home\model;
use app\home\model\Common;
use traits\model\SoftDelete;
class Like extends Common
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $hidden = ['m_password'];
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $autoWriteTimestamp = true;

    public function createData($param){
        return parent::createData($param);
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