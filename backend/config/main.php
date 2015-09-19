<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableRegistration' => true,
            'admins' => ['admin', 'webmaster'],
            'modelMap' => [
                'Profile' => 'cms\models\Profile',
            ],
        ],
        'cms' => [
            'class' => 'cms\Module',
            'attemptsBeforeCaptcha' => 3, // Optional
        ],
        'blog' => [
            'class' => 'blog\backend\Module',
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
    ],
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' =>
        [
            'class'=>'yii\web\View',
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/security/login' => '@cms/views/security/login',
                    '@dektrium/user/views' => ['@cms/views', '@dektrium/user/views'],
                    '@dektrium/user/views/admin' => ['@cms/views/admin', '@dektrium/user/views/admin']
                ],   // for Admin theme which resides on extension/adminui
                //'baseUrl' => '@web/themes/adminui',
            ],
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                    'cachePath' => '@runtime/Smarty/cache',
                    'widgets' => [
                        'functions' => [
                            'GridView' => 'yii\grid\GridView',
                        ],
                    ]
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
