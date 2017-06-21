<?php
namespace app\admin\controller;

use \think\Controller;
use app\admin\model\User;
use \think\Request;

class UserController extends Controller
{
    public function index() {
        //普通用户
        $userList = User::all();
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $userList);
        return $this->fetch('user/index');
    }
//    public function administrator() {
//        //管理员
//        $userList = User::all(['user_role_id' => 1]);
//        $myorder = 0;
//        $this->assign('myorder', $myorder);
//        $this->assign('list', $userList);
//        return $this->fetch('user/index');
//    }

    public function add(Request $request) {
        $data = $request->param();
        $user = User::create($data);
        if ($user) {
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }

    }

    public function update(Request $request) {
        $userId = $request->param("id");
        $user = User::get($userId);
        $user->name = $request->param("name");
        $result = $user->save();
        return json(["code" => $result]);
    }

    public function delete(Request $request) {
        $userId = $request->param("id");
        $user = User::get($userId);
        if ($user) {
            $user->delete();
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }

    }

}