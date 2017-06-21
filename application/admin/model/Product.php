<?php
namespace app\admin\model;

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
}