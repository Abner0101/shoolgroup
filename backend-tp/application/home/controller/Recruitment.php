<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;

class Recruitment extends ApiCommon
{
	public function addRec(){
		$param = $this->param;
		$RecModel = model('Recruitment');
		$result = $RecModel->createData($param);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}


	public function editRec(){
		$param = $this->param;
		$RecModel = model('Recruitment');
		$result = $RecModel->editData($param, $param['id']);
		if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
	}

    public function delRec(){
        $param = $this->param;
        $RecModel = model('Recruitment');
        $result = $RecModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }


}