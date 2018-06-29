<?php
/**
 * 测试环境的配置文件
 * Created by PhpStorm.
 * User: wangyutian
 * Date: 2018/4/2
 * Time: 11:06
 */
return [
    'log' => 'log/system.log',
    'template' => 'templates_c',
    'phpSettings' => [
        'date.timezone'=>'Asia/Shanghai',
        'display_startup_errors'=>1,
        'display_errors' => 1,
        'error_reporting' => E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT
    ],
    'db' => [
        'host' => '192.168.200.36',
        'port' => 3306,
        'user' => 'root',
        'password' => '223238',
        'dbname' => 'zhoubao',
    ],
    'auth' => 'on',
    'aclFunction' => 'Group_Model_User::getAcl',
];