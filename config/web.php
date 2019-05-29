<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'en',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@img' => '@app/web/img/'
    ],

    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
            // 'admins' => ['admin'],
        ],
    ],

    'components' => [

        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => "@app/messages"
                ]
            ]
        ],
        'bootstrap' => [
            'class' => \app\components\Bootstrap::class
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'y2_eAsCTiyGPfb08DTb0ZbmfBOGLgk9Z',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,

        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                'tasks' => 'task/index',
//                'task/<id>' => 'task/one',
//                'about' => 'site/about',
//                'contact' => 'site/contact',
//                'login' => 'site/login',
//                'delete' => 'task/delete',
//                'update' => 'task/update',
//                'save' => 'task/save',
//
//
//            ],
//        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
