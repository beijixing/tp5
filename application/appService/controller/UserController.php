<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:10
 */

namespace app\appService\controller;


use think\Request;
use app\appService\model\Address;
use app\appService\model\Order;

class UserController
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

    public function login(Request $request) {
        //查询user是否存在,不存在则登录成功后添加用户到数据库
    }
}