<?php
namespace app\club\model;
use app\club\model\Common;
use traits\model\SoftDelete;
class Table extends Common
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