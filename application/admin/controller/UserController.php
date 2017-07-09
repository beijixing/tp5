<?php
namespace app\admin\controller;

use \think\Controller;
use app\admin\model\User;
use \think\Request;

class UserController extends BaseController
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
        $user->user_role_id = $request->param("user_role_id");
        $user->phone = $request->param("phone");
        $user->email = $request->param("email");
        $user->sex = $request->param("sex");
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

    public function userTest(Request $request) {

        return json_encode(['code'=> '1', 'data'=>$request->param(), 'method'=>$request->method()]);
    }

    public function upload(Request $request) {

        $file = $request->file('file');

        $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
        if ($info) {
            //成功上传图片
            $filePath = $request->domain().dirname($_SERVER['SCRIPT_NAME']).'/public/uploads'.$info->getSaveName();
            return json(['fileName' => $filePath ]);
//            echo $info->getSaveName();
//            echo $info->getFilename();
        }else {
            return json( ['error' => $info->getError() ]);
        }
    }

}