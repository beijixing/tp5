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

        $file= $_FILES['file'];
        $name = $file['name'];
        $tmpName = $file['tmp_name'];
        $error = $file['error'];
        $path = ROOT_PATH.'public'.DS.'uploads/';
        $msg = array();
        if($error != 0 ){//返回代码不为0是表示上传失败，为0则为成功
            $msg['statusCode'] = 0;
            switch($error) {
                case 1:
                    $msg['message'] = "文件大小超出了服务器的空间大小 ";
                    break;

                case 2:
                    $msg['message'] = "要上传的文件大小超出浏览器限制 ";
                    break;

                case 3:
                    $msg['message'] = "文件仅部分被上传";
                    break;

                case 4:
                    $msg['message'] = "没有找到要上传的文件";
                    break;

                case 5:
                    $msg['message'] = "服务器临时文件夹丢失";
                    break;

                case 6:
                     $msg['message'] = "文件写入到临时文件夹出错";
                    break;
            }
        }else{
            move_uploaded_file($tmpName, $path. $name);
            $msg['statusCode'] = 1;
            $msg['message'] = '上传文件成功！';
        }

        if ($msg['statusCode'] = 1) {
            //成功上传图片
            $fileAbsolutePath = $request->domain(). dirname($_SERVER['SCRIPT_NAME']).'/public/uploads/'.$name;
            return json(['fileName' => $fileAbsolutePath]);
        }else {
            return json( ['error' => $msg['message'] ]);
        }

    }

}