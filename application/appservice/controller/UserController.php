<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:10
 */

namespace app\appservice\controller;


use app\appservice\model\User;
use think\Request;

use app\appservice\model\Address;
use app\appservice\model\Order;

class UserController extends BaseController
{
    /*
    * 根据user_id、state
    * */
    public function orderListByState(Request $request) {
        $orderList = Order::all(['user_id' => $request->param('user_id'),
            'state' => $request->param('state')
        ]);

        if ($orderList) {
            return json_encode([
                'code' => 1,
                'message' => 'ok',
                'data' => ['order_list' => $orderList]
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '获取失败',
            ]);
        }
    }

    /*
    * 根据user_id
    * */
    public function orderList(Request $request) {
        $orderList = Order::all(['user_id' => $request->param('user_id')]);

        if ($orderList) {
            return json_encode([
                'code' => 1,
                'message' => 'ok',
                'data' => ['order_list' => $orderList]
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '获取失败',
            ]);
        }
    }

    /*
     * 根据user_id 获取他的所有收货地址
     * */
    public function address(Request $request) {
        $addressList = Address::all(['user_id' => $request->param('user_id')]);
        if ($addressList) {
            return json_encode([
                'code' => 1,
                'message' => 'ok',
                'data' => ['address_list' => $addressList]
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => 'ok',
            ]);
        }
    }

    public function addUser(Request $request) {
            if (!$this->isLogin()) {
                return $this->unloginTip();
            }

            $user = User::getByIdentifier($request->param("identifier"));
            if ($user) {
                $user["name"] = $request->param("nickname");
                $user["header_icon"] = $request->param("icon");
                if ($user->save()) {
                    return json_encode(["code" => 1, "message"=>"更新成功"]);
                }else {
                    return json_encode(["code" => 0, "message"=>"更细失败"]);
                }
            }else {
                $user = new User();
                $user["name"] = $request->param("nickname");

                $user["identifier"] = $request->param("identifier");
                $user["header_icon"] = $request->param("icon");
                $user["user_role_id"] = 2;

                if ($user->save()) {
                    return json_encode(["code" => 1, "message"=>"添加成功"]);
                }else {
                    return json_encode(["code" => 0, "message"=>"添加失败"]);
                }
            }

    }
}