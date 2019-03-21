<?php
namespace app\home\model;
use app\home\model\Common;
use traits\model\SoftDelete;
class Staff extends Common
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	protected $hidden = ['create_time','update_time','delete_time'];
	protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
	protected $autoWriteTimestamp = true;
	public function createData($param){
		if($_FILES){
			$file = request()->file('img');
	        // 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

	        if($info){
	            $img_src = '/uploads/'.$info->getSaveName();
	            $img_src = str_replace('\\','/',$img_src);
	            $param['img'] = $img_src;
	        }else{
	            // 上传失败获取错误信息
	            return ['code'=>0,'msg'=>$file->getError()];
	        }
        }else{
        	$param['img'] ="/uploads/img/moren.jpg";
        }
		return parent::createData($param);
	}

	public function editData($param, $id){
		if($_FILES){
			$file = request()->file('img');
	        // 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

	        if($info){
	            $img_src = '/uploads/'.$info->getSaveName();
	            $img_src = str_replace('\\','/',$img_src);
	            $param['img'] = $img_src;
	        }else{
	            // 上传失败获取错误信息
	            return ['code'=>0,'msg'=>$file->getError()];
	        }
	    }
		return parent::editData($param, $id);
	}
	public function delData($param){
		return parent::delData($param);
	}
	public function getDataById($param){
		return parent::getDataById($param);
	}
	public function getAllDatas(){
		return parent::getAllDatas();
	}
}