<?php
namespace app\admin\model;

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
    // 定义全局的查询范围
//    protected function base($query)
//    {
//        $query->where('user_role_id',1);
//    }

}