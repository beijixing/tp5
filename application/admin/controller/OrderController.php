<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/6
 * Time: 上午7:39
 */

namespace app\admin\controller;
use \think\Controller;
use app\admin\model\Order;
class OrderController extends Controller
{
    //已完成订单
    public function finished() {
        $orderList = Order::all(['state' => '5']);
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $orderList);
        return $this->fetch('order/index');
    }

    //未发货订单
    public function unshipped() {
        $orderList = Order::all(['state' => '3']);
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $orderList);
        return $this->fetch('order/index');
    }

    //已发货订单
    public function shipped() {
        $orderList = Order::all(['state' => '4']);
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $orderList);
        return $this->fetch('order/index');
    }

}