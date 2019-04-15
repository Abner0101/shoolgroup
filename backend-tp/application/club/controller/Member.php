<?php
namespace app\club\controller;

use app\club\controller\ApiCommon;

class Member extends ApiCommon{

    public function editMember(){
        $param = $this->param;
        $memberModel = model('Member');
        $result = $memberModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    // public function delTable(){
    //     $param = $this->param;
    //     $tableModel = model('Table');
    //     $result = $tableModel->delData($param);
    //     if(isset($param['callback']))
    //         return resultJsonp($result);
    //     else
    //         return resultArray($result);
    // }

    
}