<?php
namespace app\manage\model;
use app\manage\model\Common;
use traits\model\SoftDelete;
class Equip extends Common
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $hidden = ['m_password'];
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $autoWriteTimestamp = true;

    public function editData($param, $id){
        return parent::editData($param, $id);
    }

    public function delData($param){
        return parent::delDataTrue($param);
    }
}