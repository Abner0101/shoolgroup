<?php
namespace app\home\controller;

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

    public function getCateById(){
        $param = $this->param;
        $cateModel = model('Cate');
        $result = $cateModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }
    public function getItemById(){
        $param = $this->param;
        $itemModel = model('Item');
        $result = $itemModel->getDataById($param);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getJobbyId(){
        $param = $this->param;
        $jobModel = model('Jobs');
        $result = $jobModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllJob(){
        $param = $this->param;
        $jobModel = model('Jobs');
        $result = $jobModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getRecbyId(){
        $param = $this->param;
        $RecModel = model('Recruitment');
        $result = $RecModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllRec(){
        $param = $this->param;
        $RecModel = model('Recruitment');
        $result = $RecModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

}