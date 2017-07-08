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

//        $file = $request->file('file');
//        $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
//        if ($info) {
//            //成功上传图片
//            $fileAbsolutePath = $request->domain(). dirname($_SERVER['SCRIPT_NAME']).'/public/uploads/'.$info->getSaveName();
//            return json(['fileName' => $fileAbsolutePath]);
////           echo $info->getSaveName();
////           echo $info->getFilename();
//        }else {
//            return json( ['error' => $info->getError() ]);
//        }


//        return json_encode(['files' => $_FILES, 'post'=> $request->post()]);
        $file = $_FILES;
        $path = ROOT_PATH.'public'.DS.'uploads/';
        $msg = nFileUpload($file, $path);

        if ($msg['statusCode'] == 0) {
            return json( ['error' => $msg['message'] ]);
        }else {

            $fileAbsolutePath = $request->domain(). dirname($_SERVER['SCRIPT_NAME']).'/public/uploads/'.$msg['dst'];

            return json( ['fileName' => $fileAbsolutePath]);
        }
    }

}