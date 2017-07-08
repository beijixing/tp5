<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


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
