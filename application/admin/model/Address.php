<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/22
 * Time: 上午7:33
 */

namespace app\admin\model;


use think\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $autoWriteTimestamp = true;
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
}