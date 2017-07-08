<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/7/8
 * Time: 下午12:12
 */

namespace app\appservice\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public function unloginTip() {
        return json_encode(['code'=>0, 'message'=>'请重新登录']);
    }

    public function isLogin() {
        $thirdSession = $this->request->param('session');
        if (Session::has($thirdSession)) {
            return true;
        }else {
            return false;
        }
    }
}