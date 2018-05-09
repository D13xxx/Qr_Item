<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],

//        'user' => [
//            'identityClass' => 'mdm\admin\models\User',
//            'loginUrl' => ['admin/user/login'],
//        ],
//            'user' => [
//            'class' => 'mdm\admin\models\User',
//            'identityClass' => 'mdm\admin\models\User',
//            'loginUrl' => ['admin/user/login'],
////                'enableAutoLogin' => true,
            'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
        ]
    ],

    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
        ]
    ],

];
