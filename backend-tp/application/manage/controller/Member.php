<?php
namespace app\manage\controller;

use app\manage\controller\ApiCommon;

class Member extends ApiCommon{
    
    public function editMember(){
        $param = $this->param;
        $MemberModel = model('Member');
        $result = $MemberModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delMember(){
        $param = $this->param;
        $memberModel = model('Member');
        $result = $memberModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }
    
}