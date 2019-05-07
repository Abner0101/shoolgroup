<?php
namespace app\club\controller;

use app\club\controller\ApiCommon;

class Equip extends ApiCommon{
    public function addEquip(){
        $param = $this->param;
        $equipModel = model('Equip');
        $result = $equipModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delEquip(){
        $param = $this->param;
        $equipModel = model('Equip');
        $result = $equipModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function editEquip(){
        $param = $this->param;
        $equipModel = model('Equip');
        $result = $equipModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }
}