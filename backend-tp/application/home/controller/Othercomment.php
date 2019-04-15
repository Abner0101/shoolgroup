<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;

class Othercomment extends ApiCommon{
    public function addOtherComment(){
        $param = $this->param;
        $commentModel = model('Othercomment');
        $result = $commentModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }


    public function delOtherComment(){
        $param = $this->param;
        $commentModel = model('Othercomment');
        $result = $commentModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}