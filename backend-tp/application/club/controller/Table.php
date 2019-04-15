<?php
namespace app\club\controller;

use app\club\controller\ApiCommon;

class Table extends ApiCommon{

    public function editTable(){
        $param = $this->param;
        $tableModel = model('Table');
        $result = $tableModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delTable(){
        $param = $this->param;
        $tableModel = model('Table');
        $result = $tableModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}