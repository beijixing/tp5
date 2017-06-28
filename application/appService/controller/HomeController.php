<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:08
 */

namespace app\appService\controller;


use phpDocumentor\Reflection\Types\Array_;
use think\Controller;
use think\Request;
use app\appService\model\Product;
use app\appService\model\Category;

class HomeController extends Controller
{

    /*
     * 返回首页的所有信息,
     * 参数:无
     * */
    public function get(Request $request) {

        //获取banner,即最新的三个商品信息
        $list = Product::all(function($query){
            $query->limit(3)->order('update_time', 'desc ');
        });
        $baner = array();

        for ($i= 0;$i< count($list); $i++){
            $product = $list[$i];
            $baner[$i] = ['banner_id' => $product->id,
                'banner_thumb' => $product->thumb_1];

        }

        //获取类别
        $categoryList = Category::all();
        //获取商品列表
        $productList = Product::all(function($query){
            $query->limit(100)->order('update_time', 'desc ');
        });

        $resultData = [
            'code' => 1,
            'message' => 'ok',
            'data' => [
                'banner' => $baner,
                'category' => $categoryList,
                'goods_list' => $productList
            ]
        ];
        return json_encode($resultData);
    }
}