<?php
namespace app\manage\controller;

use app\manage\controller\ApiCommon;

class Manager extends ApiCommon{
    public function addManager(){
        $param = $this->param;
        $managerModel = model('Manager');
        $result = $managerModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function editManager(){
        $param = $this->param;
        $managerModel = model('Manager');
        $result = $managerModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delManager(){
        $param = $this->param;
        $managerModel = model('Manager');
        $result = $managerModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}