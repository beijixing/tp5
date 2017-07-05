<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:10
 */

namespace app\appservice\controller;


use think\Request;
use app\appservice\model\Address;
use app\appservice\model\Order;

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

    }

    public function HttpGet($url){
        $curl = curl_init ();
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
          // curl_setopt ( $curl, CURLOPT_TIMEOUT, 500 );
          // curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36');

         //如果用的协议是https则打开鞋面这个注释
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

         $res = curl_exec ( $curl );
         curl_close ( $curl );
         return $res;
     }


    public function add(Request $request) {
        $pr_bits = '';
        // Unix/Linux platform?
        $fp = @fopen('/dev/urandom','rb');
        if ($fp) {
            $pr_bits .= @fread($fp,16);
            @fclose($fp);
        }

        if ($pr_bits) {
            $pr_bits = md5($pr_bits);
        }

        return json_encode(["random" => $pr_bits ]);
    }
}