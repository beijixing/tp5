<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/7/9
 * Time: 上午10:21
 */

namespace app\admin\controller;


use think\Controller;

class UploadController extends Controller
{
    public function index() {
        return $this->fetch();
    }

    public function upload() {
        $file= $_FILES['file'];
        $name = $file['name'];
        $tmpName = $file['tmp_name'];
        $error = $file['error'];
        $path = ROOT_PATH.'public'.DS.'uploads/';

        if($error != 0 ){//返回代码不为0是表示上传失败，为0则为成功
            $msg['statusCode'] = 0;
            $msg['message'] = '上传文件失败！';
        }else{
            move_uploaded_file($tmpName, $path. $name);
            $msg['statusCode'] = 1;
            $msg['message'] = '上传文件成功！';
        }
        
    }

}