<?php
//配置文件
return [
    'view_replace_str' => [
        '__media__' => dirname($_SERVER['SCRIPT_NAME']).'/public/static/media',
        '__static__' => dirname($_SERVER['SCRIPT_NAME']).'/public/static',
    ]
];