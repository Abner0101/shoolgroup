<?php
namespace app\home\controller;

use app\home\controller\ApiCommon;

class Comment extends ApiCommon{
    public function addComment(){
        $param = $this->param;
        $commentModel = model('Comment');
        $result = $commentModel->createData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }


    public function delComment(){
        $param = $this->param;
        $commentModel = model('Comment');
        $result = $commentModel->delData($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    
}