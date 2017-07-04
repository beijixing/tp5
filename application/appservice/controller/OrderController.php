<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/24
 * Time: 上午10:29
 */

namespace app\appService\controller;


use app\appService\model\Order;
use app\appService\model\OrderItems;
use think\Request;

class OrderController
{
    /*
     * 生成订单:user_id,商品列表,收件地址
     * */
    public function add(Request $request) {
        $order = new Order();
        $order['order_code'] = '';
        $order['total_price'] = $request->param('total_price');
        $order['state'] = '1';
        $order['user_id'] = $request->param('user_id');
        $order['address_id'] = $request->param('address_id');

        $order->save();


        $productList = $request->param('product');//数组或者字典
        if (count($productList) == count($productList, 1)) {//字典 product_id, count
            $orderItem = new OrderItems($productList);
            $orderItem['order_id'] = $order->id;
            $orderItem->save();
        }else{
            //数组,有多条记录
            $list = array();
            foreach($productList as $key=> $val){
                $val['order_id'] = $order->id;
                array_push($list, $val);
            }
            $orderItem = new OrderItems;
            $orderItem->saveAll($list);
        }


        return json_encode(['code' => '已生成订单']);

    }


    /*
        * 删除订单:user_id,order_id
        * */
    public function delete(Request $request) {
        //删除订单中的商品信息
        $result = OrderItems::destroy(['order_id' => $request->param('order_id')]);

        $result = Order::destroy(['id' => $request->param('order_id')]);
        if ($result) {
            json_encode(['code' => 1, 'message' => '删除成功']);
        }else {
            json_encode(['code' => 0, 'message' => '删除失败']);
        }

    }

    /*
    * 删除订单中的商品:order_id, product_id
    * */
    public function deleteOrderItem(Request $request) {

        $order = OrderItems::get(['id' => $request->param('order_id'),
            'product_id'=> $request->param('product_id')]);

        $result = $order->delete();

        if ($result) {
            json_encode(['code' => 1, 'message' => '删除成功']);
        }else {
            json_encode(['code' => 0, 'message' => '删除失败']);
        }
    }

    /*
    * 更新订单:user_id,order_id
    * */
    public function update(Request $request) {

        $order = Order::get(['id' => $request->param('order_id')]);

        $result = $order->allowField(true)->isUpdate(true)->save();

        if ($result) {
            json_encode(['code' => 1, 'message' => '更新成功']);
        }else {
            json_encode(['code' => 0, 'message' => '更新失败']);
        }
    }



}