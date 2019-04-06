<?php
namespace app\manage\model;
use think\Model;


class Common extends Model 
{

	public function getDataById($param){
		// 验证ID正整数
		$validate = validate('IDMustBePositiveInt');
		if (!$validate->check($param)) {
			return ['error' => $validate->getError()];
		}
		$data = $this->get($param['id']);
		if(empty($data))
			$data = ['error' => '数据为空，请核实ID'];
		return ['data' => $data];
		// if(isset($param['id'])){
		// 	$data = $this->get($param['id']);
		// 	if(empty($data))
		// 		$data = ['error' => '数据为空，请核实ID'];
		// }else{
		// 	$data =  ['error' => 'id为空'];
		// }
		// $data = $this->get($param['id']);
		// return $data;
	}
	public function editData($param, $id){
		$checkData = $this->get($id);
		if (!$checkData) {
			return ['error' => '暂无此数据'];
		}
		// 验证
		$validate = validate($this->name);
		if (!$validate->check($param)) {
			return ['error' => $validate->getError()];
		}
		$this->startTrans();
		try {
			$this->allowField(true)->save($param, [$this->getPk() => $id]);
			$this->commit();
			return ['data' => '编辑成功'];
		} catch(\Exception $e) {
			$this->rollback();
			return ['error' => '编辑失败', 'param'=>$param];
		}
	}
	public function createData($param){
		// 验证
		$validate = validate($this->name);
		if (!$validate->check($param)) {
			$this->error = $validate->getError();
			return ['error' => $validate->getError()];
		}
		// if(isset($param['callback']))
		// 	unset($param['callback']);
		$this->startTrans();
		try {
			// $this->data($param)->allowField(true)->save();
			$this->allowField(true)->save($param);
			$this->commit();
			return ['data' => '添加成功'];
		} catch(\Exception $e) {
			$this->rollback();
			return ['error' => '添加失败', 'param'=>$param];
		}
	}
	public function getAllDatas(){
		$data = $this->select();
		if(empty($data))
			$data = ['error' => '数据为空，请核实'];
		return ['data' => $data];
	}

	//软删除
	public function delData($param){
		// 验证ID正整数
		$validate = validate('IDMustBePositiveInt');
		if (!$validate->check($param)) {
			return ['error' => $validate->getError()];
		}
		$checkData = $this->get($param['id']);
		if (!$checkData) {
			return ['error' => '暂无此数据'];
		}
		$this->startTrans();
		try {
			$res=$this->where('id', $param['id'])->find();
			$res->delete();
			$this->commit();
			if($this->find($param['id']))
				return ['error' => '删除失败，数据仍在'];
			else
				return ['data' => '删除成功'];
		} catch(\Exception $e) {
			$this->rollback();
			return ['error' => '删除失败' . $e, 'param'=>$param];
		}
	}

	//真删除
	public function delDataTrue($param){
		// 验证ID正整数
		$validate = validate('IDMustBePositiveInt');
		if (!$validate->check($param)) {
			return ['error' => $validate->getError()];
		}
		$checkData = $this->get($param['id']);
		if (!$checkData) {
			return ['error' => '暂无此数据'];
		}
		$this->startTrans();
		try {
			$res=$this->where('id', $param['id'])->find();
			$res->delete(true);
			$this->commit();
			if($this->find($param['id']))
				return ['error' => '删除失败，数据仍在'];
			else
				return ['data' => '删除成功'];
		} catch(\Exception $e) {
			$this->rollback();
			return ['error' => '删除失败' . $e, 'param'=>$param];
		}
	}

   //上传图片
	public function upimg($param,$files){
		if(is_array($files)){
			foreach($files as $fileName){
				$file =  request()->file($fileName);
				// 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
			    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			    if($info){
		            $img_src = '/uploads/'.$info->getSaveName();
		            $img_src = str_replace('\\','/',$img_src);
		            $param[$fileName] = $img_src;
		        }else{
		            // 上传失败获取错误信息
		            return ['code'=>0,'msg'=>$file->getError()];
		        }
			}
			return $param;
        }else{
        	// dump("非数组！");die;
	        $file =  request()->file($files);
			// 移动到框架应用根目录/public/uploads/ 目录下。最大图片为10240000byte
		    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		    if($info){
	            $img_src = '/uploads/'.$info->getSaveName();
	            $img_src = str_replace('\\','/',$img_src);
	            $param[$files] = $img_src;
	            return $param;
	        }else{
	            // 上传失败获取错误信息
	            return ['code'=>0,'msg'=>$file->getError()];
	        }
        }
	}


}