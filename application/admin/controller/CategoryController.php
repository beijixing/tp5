<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/5
 * Time: 下午10:24
 */

namespace app\admin\controller;

use \think\Controller;
use app\admin\model\Category;
use think\Request;

class CategoryController extends Controller
{
    public function index() {
        $categoryList = Category::all();
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $categoryList);
        return $this->fetch();
    }

    public function getCategory() {
        $categoryList = Category::all();
        return json_encode($categoryList);
    }


    public function add(Request $request) {
        $data = $request->param();
        $category = Category::create($data);
        if ($category) {
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }
    }

    public function update(Request $request) {
        $categoryId = $request->param("id");
        $category = Category::get($categoryId);
        $category->name = $request->param("name");
        $category->small_text = $request->param("small_text");
        $result = $category->save();
        return json(["code" => $result]);
    }

    public function delete(Request $request) {
        $categoryId = $request->param("id");
        $category = Category::get($categoryId);
        if ($category) {
            $category->delete();
            return json(["code" => 1]);
        }else {
            return json(["code" => 0]);
        }

    }

}