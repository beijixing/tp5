<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/7/8
 * Time: 下午12:17
 */

namespace app\appservice\controller;

use lib\HTTPHelper;
use lib\Util;
use think\Session;
use think\Request;

class LoginController
{
    public function onLogin(Request $request) {
        //用code 换取 session_key
        //返回自己服务端生成的session
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx8b936b48606379ad&secret=3499f32931d4a82056de9bc6a9fad2d3&js_code='.
            $request->param('code').'&grant_type=authorization_code';

        $httpHelper = new HTTPHelper();
        $result = $httpHelper->HttpGet($url);
        $jsonRes = json_decode($result);
        $thirdSession = Util::random_16();

        Session::set($thirdSession, $result);

        return json_encode(["code"=>1, "message"=>"ok", "data"=> ["thirdSession"=> $thirdSession, "identifier"=>$jsonRes->openid, 'sessionid'=> session_id()] ]);

    }
}