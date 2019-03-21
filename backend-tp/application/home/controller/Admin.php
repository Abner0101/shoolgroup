<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;


class Admin extends ApiCommon
{
	public function editCate(){
		$param = $this->param;
		$cateModel = model('Cate');
		$result = $cateModel->editData($param, $param['id']);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function editItem(){
		$param = $this->param;
		$itemModel = model('Item');
		$result = $itemModel->editData($param, $param['id']);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function addCate(){
		$param = $this->param;
		$cateModel = model('Cate');
		$result = $cateModel->createData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function addItem(){
		$param = $this->param;
		$itemModel = model('Item');
		$result = $itemModel->createData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}

	public function delItem(){
		$param = $this->param;
        $itemModel = model('Item');
        $result = $itemModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}

	public function delCate(){
		$param = $this->param;
        $cateModel = model('Cate');
        $result = $cateModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}


	public function getAllUsers(){
		$param = $this->param;
		$userModel = model('User');
		$result = $userModel->getAllDatas();
		// p($result);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function getUserById(){
		$param = $this->param;
		$userModel = model('User');
		$result = $userModel->getDataById($param);
		// p($result);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function addUser(){
		$param = $this->param;
		$userModel = model('User');
		$result = $userModel->createData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function editUser(){
		$param = $this->param;
		$userModel = model('User');
		$result = $userModel->editData($param, $param['id']);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}
	public function delUser(){
		$param = $this->param;
		$userModel = model('User');
		$result = $userModel->delData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}

}