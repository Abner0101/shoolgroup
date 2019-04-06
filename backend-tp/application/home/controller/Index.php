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

    public function getClubbyId(){
        $param = $this->param;
        $clubModel = model('Club');
        $result = $clubModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllclub(){
        $param = $this->param;
        $clubModel = model('Club');
        $result = $clubModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getTablebyId(){
        $param = $this->param;
        $tableModel = model('Table');
        $result = $clubModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAlltable(){
        $param = $this->param;
        $tableModel = model('Table');
        $result = $clubModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

   

}