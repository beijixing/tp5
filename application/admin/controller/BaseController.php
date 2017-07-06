<?php
/**
 * Created by PhpStorm.
 * User: horse
 * Date: 2017/7/6
 * Time: 上午9:57
 */

namespace app\admin\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    function _initialize()
    {
        $this->checkLogin();
    }

    public function checkLogin() {
        if (!Session::has('username')) {
            $this->redirect(url('admin/login/index'));
        }
    }
}