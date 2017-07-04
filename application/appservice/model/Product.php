<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:23
 */

namespace app\appService\model;


use think\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $autoWriteTimestamp = true;
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i',
        'update_time' => 'timestamp:Y-m-d H:i',
    ];

    //多对一用belongsTo
    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function cart() {
        return $this->belongsToMany("User", 'cart_has_product');
    }

    public function history() {
        return $this->belongsToMany("User", 'user_has_product');
    }

    public function orderItems() {
        return $this->belongsToMany("Order", 'order_has_product');
    }
}