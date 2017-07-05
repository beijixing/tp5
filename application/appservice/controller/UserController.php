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
use lib\HTTPHelper;
use lib\Util;
use app\appservice\model\Address;
use app\appservice\model\Order;
use think\Session;

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

    public function onLogin(Request $request) {
        //查询user是否存在,不存在则登录成功后添加用户到数据库
        //用code 换取 session_key
        //返回自己服务端生成的session
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx8b936b48606379ad&secret=3499f32931d4a82056de9bc6a9fad2d3&js_code='.
            $request->param('code').'&grant_type=authorization_code';

        $httpHelper = new HTTPHelper();
        $result = $httpHelper->HttpGet($url);
        $jsonRes = json_decode($result);
        $thirdSession = Util::random_16();
        Session::set($thirdSession, $result);

        return json_encode(["code"=>1, "message"=>"ok", "data"=> ["thirdSession"=> $thirdSession, "identifier"=>$jsonRes->openid] ]);

    }


    public function addUser(Request $request) {
        $thirdSession = $request->param("thirdSession");
        if (Session::has($thirdSession)) {
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

        }else {
            return json_encode(["code" => 0, "message"=>"请重新登录"]);
        }
    }
}