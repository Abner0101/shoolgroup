<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;

class Club extends ApiCommon{
    public function addClub(){
        $param = $this->param;
        $clubModel = model('Club');
        $result = $clubModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function editClub(){
        $param = $this->param;
        $clubModel = model('Club');
        $result = $clubModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delClub(){
        $param = $this->param;
        $clubModel = model('Club');
        $result = $clubModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}