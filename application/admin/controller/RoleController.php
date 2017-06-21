<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/5
 * Time: 下午8:11
 */

namespace app\admin\controller;
use \think\Controller;
use app\admin\model\Role;
use think\Request;

class RoleController extends Controller
{
    public function index () {
        $roleList = Role::all();
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $roleList);
        return $this->fetch();
    }

    public function add(Request $request) {
        $data = $request->param();
        $role = Role::create($data);
        if ($role) {
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }

    }

    public function update(Request $request) {
        $roleId = $request->param("id");
        $role = Role::get($roleId);
        $role->name = $request->param("name");
        $result = $role->save();
        return json(["code" => $result]);
    }

    public function delete(Request $request) {
        $roleId = $request->param("id");
        $role = Role::get($roleId);
        if ($role) {
            $role->delete();
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }
    }

    public function getRole() {
        $roleList = Role::all();
        return json_encode($roleList);
    }
}