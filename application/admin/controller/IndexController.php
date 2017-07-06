<?php
namespace app\admin\controller;
use \think\Controller;
use think\Session;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
        echo 'index login';
    }
}
