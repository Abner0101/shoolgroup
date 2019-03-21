<?php
namespace app\home\model;
use app\home\model\Common;
use traits\model\SoftDelete;
class Recruitment extends Common
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	protected $hidden = ['create_time','update_time','delete_time'];
	protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
	protected $autoWriteTimestamp = true;
	public function createData($param){
		$files=[];
		if($_FILES){
			// dump($_FILES);die;
			foreach ($_FILES as $key => $value) {
				$files[]=$key;
			}
			$temp=$this->upimg($param,$files);
			return parent::createData($temp);
		}else{
			return parent::createData($param);
		}	
	}

	public function editData($param, $id){
		$files=[];
		if($_FILES){
			// dump($_FILES);die;
			foreach ($_FILES as $key => $value) {
				$files[]=$key;
			}
			$temp=$this->upimg($param,$files);
		    return parent::editData($temp, $id);
		}else{
			return parent::editData($param, $id);
		}
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