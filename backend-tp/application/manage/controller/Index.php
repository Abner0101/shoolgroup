<?php
namespace app\manage\controller;

use app\common\controller\Common;
// use app\home\model\Cate;

class Index extends Common
{
    public function index(){
        $param = $this->param;
        if(isset($param['callback']))
            return resultJsonp(['data' => 'this is home/index']);
        else
            return resultArray(['data' => 'this is home/index']);
    }

    public function getManagerById(){
        $param = $this->param;
        $managerModel = model('Manager');
        $result = $managerModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllManager(){
        $param = $this->param;
        $managerModel = model('Manager');
        $result = $managerModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }



}