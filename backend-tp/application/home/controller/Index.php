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
        $result = $tableModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAlltable(){
        $param = $this->param;
        $tableModel = model('Table');
        $result = $tableModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getLikebyId(){
        $param = $this->param;
        $likeModel = model('Like');
        $result = $likeModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllLike(){
        $param = $this->param;
        $likeModel = model('Like');
        $result = $likeModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }


    public function getCommentbyId(){
        $param = $this->param;
        $commentModel = model('Comment');
        $result = $commentModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllComment(){
        $param = $this->param;
        $commentModel = model('Comment');
        $result = $commentModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getOtherCommentbyId(){
        $param = $this->param;
        $commentModel = model('Othercomment');
        $result = $commentModel->getDataById($param);
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

    public function getAllOtherComment(){
        $param = $this->param;
        $commentModel = model('Othercomment');
        $result = $commentModel->getAllDatas();
        // p($result);
        if(isset($param['callback']))
            return resultJsonp($result);
        else
            return resultArray($result);
    }

   

}