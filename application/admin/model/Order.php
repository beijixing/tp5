<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/15
 * Time: 下午10:12
 */

namespace app\admin\model;

use \think\Model;
class Order extends Model
{
    protected $table = 'eorder';
    protected $autoWriteTimestamp = true;
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i:s',
    ];

    public function address()
    {
        return $this->belongsTo('Address');
    }

    public function user() {
        return $this->belongsTo('User');
    }
}