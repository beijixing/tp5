<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:23
 */

namespace app\appservice\model;


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

    public function orderItems() {
        return $this->belongsToMany('Product', 'order_has_product');
    }
}