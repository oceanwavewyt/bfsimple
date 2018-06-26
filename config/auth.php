<?php
/**
 * 正式环境的配置文件
 * Created by PhpStorm.
 * User: wangyutian
 * Date: 2018/3/29
 * Time: 15:38
 */
return [
    'login' => '/user/index/login/',
    //设置cookie时候需要设置的字段
    'cookie' => [
        'id','username','email'
    ],
    'authkey' => 'AFBze%~mG7G>0W|!gI*]Zh{1p`inzd-^',
    'resource' => [
         'deny'=> [], //所有模块和控制器必须登录,'为空表示所有'
         'allow'=>[], //允许模块和控制器不用登录
    ]
];