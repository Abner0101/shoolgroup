<?php
namespace app\manage\controller;

use app\manage\controller\ApiCommon;

class Comment extends ApiCommon{

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