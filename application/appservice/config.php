<?php
//配置文件
return [
    'session' => [
        'type'              => 'Mysql', // 驱动方式 支持redis memcache memcached
        'auto_start'        => true,        // 是否自动开启 SESSION
        // Session驱动设置
        'session_expire'    => 3600,        // Session有效期 单位：秒
        'session_prefix'    => 'think_',    // Session前缀
        'table_name'        => 'think_session',   // 表名（不包含表前缀）
    ],
];