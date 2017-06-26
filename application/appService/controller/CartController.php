<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:09
 */

namespace app\appService\controller;

use \think\Controller;
use \think\Request;
use app\appService\model\Cart;

class CartController extends Controller
{

    /*
     * 获取用户的购物车列表
     * 参数: user_id, 用户id
     * */
    public function get(Request $request) {
        $userCart = Cart::all(['user_id' => $request->param('user_id')]);
        if ($userCart) {
            return json_encode([
                'code' => 1,
                'message' => 'ok',
                'data' => $userCart
            ]);
        }else {

        }
    }
    /*
     * 向用户的购物车中添加商品
     * 参数: user_id, 用户id
     *      product_id,商品id
     *      count 商品数量
     * */
    public function add(Request $request) {
        $cart = new Cart($request->param());
        $result = $cart->allowField(true)->save();

        if ($request) {
            return json(['code' => 1, 'message' => '添加成功']);
        }else {
            return json(['code' => 0, 'message' => '添加失败']);
        }
    }

    /*
     * 向用户的购物车中添加商品
     * 参数: user_id, 用户id
     * 参数: product_id,商品id
     * */
    public function delete(Request $request) {
        $userId = $request->param('user_id');
        $productId = $request->param('product_id');
        $result = Cart::destroy(['user_id' => $userId, 'product_id' => $productId]);
        if ($result) {
            return json(['code' => 1, 'message' => '删除成功']);
        }else {
            return json(['code' => 0, 'message' => '删除失败']);
        }
    }
    /*
     * 向用户的购物车中添加商品
     * 参数: user_id, 用户id
     *      product_id,商品id
     *      count 商品数量
     * */
    public function update(Request $request) {
        $cart = Cart::get([ 'user_id' => $request->param('user_id'),
            'product_id' => $request->param('product_id')]);
        $cart->count = $request->param('count');
        if ($cart->isUpdate(true)->save()) {
            return json(['code' => 1, 'message' => '更新成功']);
        }else {
            return json(['code' => 0, 'message' => '更新失败']);
        }
    }


    public function clear($userId) {
        $result = Cart::destroy(['user_id' => $userId]);
        if ($result) {
            return json(['code' => 1, 'message' => '清理成功']);
        }else {
            return json(['code' => 0, 'message' => '清理失败']);
        }
    }

    public function clearCart(Request $request) {
        return $this->clear($request->param('user_id'));
    }

}