<?php
namespace app\home\model;
use app\home\model\Common;
use traits\model\SoftDelete;
class Item extends Common
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	protected $hidden = ['create_time','update_time','delete_time'];
	protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
	protected $autoWriteTimestamp = true;

	public function cate(){
        return $this->belongsTo('Cate', 'cate_id', 'id');
    }
    public function getDataById($param){
		return parent::getDataById($param);
	}
	public function editData($param, $id){
		return parent::editData($param, $id);
	}
	public function createData($param){
		return parent::createData($param);
	}
	public function delData($param){
		return parent::delData($param);
	}
}