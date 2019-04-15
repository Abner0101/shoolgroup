<?php
namespace app\home\controller;
use app\home\controller\ApiCommon;

class Like extends ApiCommon{
    public function addLike(){
        $param = $this->param;
        $likeModel = model('Like');
        $result = $likeModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function delLike(){
        $param = $this->param;
        $likeModel = model('Like');
        $result = $likeModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}