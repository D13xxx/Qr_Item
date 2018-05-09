<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ],
        
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // 'showScriptName' => false,  // Disable index.php
            'enablePrettyUrl' => true,  // Disable r= routes
//             'suffix' => '.html',
            'rules' => array(
              
            ),
        ],
//        'as access' => [
//            'class' => 'mdm\admin\components\AccessControl',
//            'allowActions' => [
//                'site/*',
//                'admin/*',
//            ]
//        ],

          'urlManagerBackend'=>[
             'enablePrettyUrl' => true,
             'class' => 'yii\web\UrlManager',
//              'showScriptName'=>false,
//              'suffix' => '.html',
//             'hostInfo' => '',
             'baseUrl' =>  'http://ngogiadiep.local:8080/ThucTap/RBAC/frontend/web/index.php/qrcode/view',
         ],
    ],
    'params' => $params,
];
