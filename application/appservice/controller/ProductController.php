<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/24
 * Time: 上午9:29
 */

namespace app\appService\controller;


use app\appService\model\Product;
use think\Request;

class ProductController
{
    /*
     * 根据参数:category_id 获取相应分类下的产品
     * */
    public function productList(Request $request) {
        $productList = Product::all(['category_id' => $request->param('category_id')]);
        if ($productList) {
            return json_encode([
                'code' => 1,
                'message' => 'OK',
                'data' => ['goods_list' => $productList]
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '获取失败'
            ]);
        }
    }

    /*
     * 根据参数:product_id 获取相应产品的详细信息
     * */
    public function detail(Request $request) {
        $product = Product::get(['id' => $request->param('product_id')]);

        if ($product) {
            return json_encode([
                'code' => 1,
                'message' => 'OK',
                'data' => $product
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '获取失败'
            ]);
        }
    }
}