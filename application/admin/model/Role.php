<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/15
 * Time: 下午8:54
 */

namespace app\admin\model;

use think\Model;

class Role extends Model
{
    protected $table = 'user_role';
    protected $autoWriteTimestamp = 'true';
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
}