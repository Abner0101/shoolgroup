<?php
namespace app\manage\controller;

use app\manage\controller\ApiCommon;

class Action extends ApiCommon{

    public function editAction(){
        $param = $this->param;
        $actionModel = model('Action');
        $result = $actionModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delAction(){
        $param = $this->param;
        $actionModel = model('Action');
        $result = $actionModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }
    
}