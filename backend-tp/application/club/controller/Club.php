<?php
namespace app\club\controller;

use app\club\controller\ApiCommon;

class Club extends ApiCommon{

    public function editClub(){
        $param = $this->param;
        $clubModel = model('Equip');
        $result = $clubModel->editData($param, $param['id']);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }
}