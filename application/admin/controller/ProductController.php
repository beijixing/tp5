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

//        return json( ['files' => $_FILES]);
        $files = $_FILES;
        $path = ROOT_PATH.'public'.DS.'uploads/';
        $msg = $this->nFileUpload($files, $path);

        if ($msg['statusCode'] == 0) {
            return json( ['error' => $msg['message'] ]);
        }else {

            $fileAbsolutePath = $request->domain(). dirname($_SERVER['SCRIPT_NAME']).'/public/uploads/'.$msg['dst'];

            return json( ['fileName' => $fileAbsolutePath]);
        }
    }

    function nFileUpload($file, $path, $saveName = false){//函数会默认将同名文件覆盖
        $dst = '';
        if($file['file']['error']){//返回代码不为0是表示上传失败，为0则为成功
            $msg['statusCode'] = 0;
            $msg['message'] = '上传文件失败！';
        }else{
            if($saveName == false){//如果保存文件名为空，则将上传的文件移动到相应目录
                $dst = $file['file']['name'];
                move_uploaded_file($file['file']['tmp_name'], $path.$file['file']['name']);
            }else{
                $arr = explode(".", $file['file']['name']);//如果保存文件名不为空，则将上传的文件移动到相应目录，并按指定文件名命名
                move_uploaded_file($file['file']['tmp_name'], $path.$saveName.".".end($arr));
            }
            $msg['statusCode'] = 1;
            $msg['message'] = '上传文件成功！';
            $msg['dst'] = $dst;
        }
        return $msg;
    }


}