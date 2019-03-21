<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;

class Staffcate extends ApiCommon
{
	public function addStaff(){
		$param = $this->param;
		$staffModel = model('Staff');
		$result = $staffModel->createData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}


	public function editStaff(){
		$param = $this->param;
		$staffModel = model('Staff');
		$result = $staffModel->editData($param, $param['id']);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}

    public function delStaff(){
        $param = $this->param;
        $staffModel = model('Staff');
        $result = $staffModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getStaffbyId(){
        $param = $this->param;
        $staffModel = model('Staff');
        $result = $staffModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllStaff(){
        $param = $this->param;
        $staffModel = model('Staff');
        $result = $staffModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }


}