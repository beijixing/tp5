<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:23
 */

namespace app\appService\model;

use \think\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $autoWriteTimestamp = true;
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
}