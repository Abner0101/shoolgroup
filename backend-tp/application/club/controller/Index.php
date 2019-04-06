<?php
namespace app\club\controller;

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

    public function getMemberById(){
        $param = $this->param;
        $memberModel = model('Member');
        $result = $memberModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllMember(){
        $param = $this->param;
        $memberModel = model('Member');
        $result = $memberModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getActionById(){
        $param = $this->param;
        $actionModel = model('Action');
        $result = $actionModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllAction(){
        $param = $this->param;
        $actionModel = model('Action');
        $result = $actionModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }



}