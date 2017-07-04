<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/23
 * Time: 下午8:24
 */

namespace app\appservice\model;


use think\Model;

class User extends Model
{
    protected $table = 'user';
    protected $autoWriteTimestamp = 'true';
    protected $type       = [
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];

    public function role()
    {
        return $this->belongsTo('Role','user_role_id');
    }

    public function address()
    {
        return $this->hasMany('Address');
    }

    public function order() {
        return $this->hasMany('Order');
    }

    public function history() {
        return $this->belongsToMany("Product", 'user_has_product');
    }

    public function cart() {
        return $this->belongsToMany("Product", 'cart_has_product');
    }
}