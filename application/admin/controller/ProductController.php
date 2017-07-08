<?php
namespace app\admin\controller;

use \think\Controller;
use think\Request;
use app\admin\model\Product;

class ProductController extends BaseController
{
    //获取商品列表
    public function index() {
        $list = Product::all();
        $myorder = 0;
        $this->assign('myorder', $myorder);
        $this->assign('list', $list);
        return $this->fetch();
    }

    //创建添加商品视图
    public function create() {
        return $this->fetch('product/add');
    }

    //添加商品
    public function add(Request $request) {

        $data = $request->param();
        $result = Product::create($data);
//        $result->save();
        //return json_encode($result);
        if ($result) {
            return json(['code' => 1]);
        }else {
            return json(['code' => 0]);
        }
    }


    public function upload(Request $request) {

//        $data = array($_FILES['file']);
//        $file= $data;
//        $name = $file['name'];
//        $tmpName = $file['tmp_name'];
//        $error = $file['error'];
//        $path = ROOT_PATH.'public'.DS.'uploads/';

//        if($error !=0 ){//返回代码不为0是表示上传失败，为0则为成功
//            $msg['statusCode'] = 0;
//            $msg['message'] = '上传文件失败！';
//        }else{
//            move_uploaded_file($tmpName, $path. $name);
//            $msg['statusCode'] = 1;
//            $msg['message'] = '上传文件成功！';
//        }
        return json( ['files' => $_FILES ,'file'=> $request->file('file'), 'name'=>"name", 'type'=>gettype($_FILES)]);

    }



}