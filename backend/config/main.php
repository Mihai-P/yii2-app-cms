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
            'enableRegistration' => false,
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
        'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'CONSUMER_KEY',
                    'consumerSecret' => 'CONSUMER_SECRET',
                ],
                'google' => [
                    'name' => 'google-plus',
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
            ],
        ],
        'view' => [
            'class'=>'yii\web\View',
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/security/login' => '@cms/views/security/login',
                    '@dektrium/user/views/admin' => ['@cms/views/admin', '@dektrium/user/views/admin'],
                    '@dektrium/user/views/recovery' => ['@cms/views/recovery', '@dektrium/user/views/recovery'],
                    '@dektrium/user/views/registration' => ['@cms/views/registration', '@dektrium/user/views/registration'],
                ],
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
