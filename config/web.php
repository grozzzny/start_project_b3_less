<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$routes = require __DIR__ . '/routes.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Kaliningrad',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'feedback' => [
            'class' => 'grozzzny\admin\modules\feedback\widgets\form\controllers\DefaultController',
            'on submit' => ['grozzzny\admin\modules\feedback\widgets\form\components\SubmitHandler', 'submit']
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'L3KpFOPujkAyXhxXX7L71iqk7b-8nxol',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            //'transport' => require __DIR__ . '/smtp.php'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        'i18n' => [
            'translations' => [
                'rus' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru-RU',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
    ],
    'modules' => [
        // https://yii2-usuario.readthedocs.io/en/latest/
        'user' => [
            'class' => Da\User\Module::class,
            'classMap' => [
                'RegistrationForm' => 'app\forms\RegistrationForm'
            ],
            'controllerMap' => [
                'admin' => [
                    'class' => 'Da\User\Controller\AdminController',
                    'layout' => '@grozzzny/admin/views/layouts/main'
                ],
                'permission' => [
                    'class' => 'Da\User\Controller\PermissionController',
                    'layout' => '@grozzzny/admin/views/layouts/main'
                ],
                'role' => [
                    'class' => 'Da\User\Controller\RoleController',
                    'layout' => '@grozzzny/admin/views/layouts/main'
                ],
                'rule' => [
                    'class' => 'Da\User\Controller\RuleController',
                    'layout' => '@grozzzny/admin/views/layouts/main'
                ],
            ],
            'administrators' => ['grozzzny'], // this is required for accessing administrative actions
            'mailParams' => [
                'fromEmail' => function() {
                    return [Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']];
                }
            ]
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'as access' => [
                'class' => 'grozzzny\admin\behaviors\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user-management'],
                    ]
                ]
            ],
            'uploadDir' => '@webroot/uploads/redactor',
            'uploadUrl' => '@web/uploads/redactor',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
        'admin' => [
            'class' => 'grozzzny\admin\AdminModule',
            'render_toolbar_role' => 'user-management',
            'live_edit_role' => 'user-management',
            'as access' => [
                'class' => 'grozzzny\admin\behaviors\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user-management'],
                    ]
                ]
            ],
            'nav_items' => [
                [
                    'label' => 'Начальная',
                    'url' => ['/admin/default']
                ],
                [
                    'label' => 'Страницы',
                    'url' => ['/admin/pages/default']
                ],
                [
                    'label' => 'Текстовые блоки',
                    'url' => ['/admin/text/default']
                ],
                [
                    'label' => 'Преимущества',
                    'url' => ['/admin/features/default']
                ],
                [
                    'label' => 'Отзывы',
                    'url' => ['/admin/testimonials/default']
                ],
                [
                    'label' => 'Обратный звонок',
                    'url' => ['/admin/feedback/default']
                ],
                [
                    'label' => 'Ссылки соц. сетей',
                    'url' => ['/admin/social_links/default']
                ],
                [
                    'label' => 'Dashboard demo',
                    'url' => 'https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html',
                ]
            ],
            'modules' => [
                'pages' => [
                    'class' => 'grozzzny\admin\modules\pages\PagesModule',
                ],
                'text' => [
                    'class' => 'grozzzny\admin\modules\text\TextModule',
                ],
                'features' => [
                    'class' => 'grozzzny\admin\modules\features\FeaturesModule',
                ],
                'testimonials' => [
                    'class' => 'grozzzny\admin\modules\testimonials\TestimonialsModule',
                ],
                'feedback' => [
                    'class' => 'grozzzny\admin\modules\feedback\FeedbackModule',
                ],
                'social_links' => [
                    'class' => 'grozzzny\admin\modules\social_links\SocialLinksModule',
                ],
            ],
        ],
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
        'generators' => [
            'crud'   => [
                'class'     => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'admin' => '@grozzzny/admin/templates/crud/default'
                ]
            ]
        ]
    ];
}

return $config;
