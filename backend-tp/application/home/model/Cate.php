<?php
namespace app\home\model;
use app\home\model\Common;
use traits\model\SoftDelete;
class Cate extends Common
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	protected $hidden = ['create_time','update_time','delete_time'];
	protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
	protected $autoWriteTimestamp = true;

	public function item(){
        return $this->hasMany('Item', 'cate_id', 'id');
    }
    public function getDataById($param){
		if(isset($param['id'])){
			$data = self::with(['item'])->find(['id' => $id]);
			if(empty($data))
				return ['error' => '数据为空，请核实ID'];
			else
				return ['data' => $data];
		}else{
			return ['data' => self::with(['item'])->select()];
		}
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