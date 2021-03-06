<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$routes = require __DIR__ . '/routes.php';

$config = [
    'id' => 'basic',
    'name' => 'my-site.com',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Kaliningrad',
    'on beforeRequest' => ['\grozzzny\admin\components\RedirectHandler', 'run'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'feedback' => [
            'class' => 'grozzzny\admin\modules\feedback\widgets\form\controllers\DefaultController',
            'on submit' => ['grozzzny\admin\modules\feedback\widgets\form\components\SubmitHandler', 'submit']
        ],
        'admin-images' => [
            'class' => 'grozzzny\admin\components\images\widget\controllers\AdminImagesController',
            'as access' => [
                'class' => 'grozzzny\admin\behaviors\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user-management'],
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'appendTimestamp' => true,
            'forceCopy' => false,
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => ['css/bootstrap/bootstrap.css'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => require __DIR__ . '/smtp.php'
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
        'formatter' => [
            'nullDisplay' => '-',
            'datetimeFormat' => 'dd.MM.yyyy HH:mm',
        ],
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => !in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1','::1']),
            'minifyOutput' => true,
            'forceCharset' => 'UTF-8',
            'compressOptions' => ['extra' => true],
        ],
        'user' => [
            'class' => 'app\components\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/security/login'],
            'identityClass' => 'app\models\User',
        ],
    ],
    'modules' => [
        // https://yii2-usuario.readthedocs.io/en/latest/
        'user' => [
            'class' => Da\User\Module::class,
            'classMap' => [
                'User' => 'app\models\User'
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

                'profile' => [
                    'class' => 'Da\User\Controller\ProfileController',
                    'layout' => '@app/views/layouts/main_with_container'
                ],
                'recovery' => [
                    'class' => 'Da\User\Controller\RecoveryController',
                    'layout' => '@app/views/layouts/main_with_container'
                ],
                'registration' => [
                    'class' => 'Da\User\Controller\RegistrationController',
                    'layout' => '@app/views/layouts/main_with_container',
                ],
                'security' => [
                    'class' => 'Da\User\Controller\SecurityController',
                    'layout' => '@app/views/layouts/main_with_container',
                    //'on beforeAuthenticate' => ['app\components\SocialNetworkHandler', 'beforeAuthenticate']
                ],
                'settings' => [
                    'class' => 'Da\User\Controller\SettingsController',
                    'layout' => '@app/views/layouts/main_with_container'
                ],
            ],
            'administrators' => ['admin'], // this is required for accessing administrative actions
            'mailParams' => [
                'fromEmail' => function() {
                    return [Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']];
                }
            ],
            'generatePasswords' => true,
            'switchIdentitySessionKey' => '',
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
            'nav_items' => function() {
                return [
                    [
                        'label' => 'Пользователи',
                        'url' => ['/user/admin'],
                        'visible' => Yii::$app->user->can('administrator')
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
                ];
            },
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
