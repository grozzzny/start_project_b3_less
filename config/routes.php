<?php

return [
    'registration' => 'user/registration/register',
    'login' => 'user/security/login',
    'logout' => 'user/security/logout',
    'forget_password' => 'recovery/request',
    'profile' => '/user/settings/profile',

    'admin' => 'admin/default/index',
    'admin/user' => 'user/admin/index',
    'admin/role' => '/permit/access/role',
    'admin/permission' => '/permit/access/permission',

    'telegram/<token:[^\/]+>' => 'telegram/default/index',

    //Page controller. Custum pages
    '<page_slug:ustav|reglament|region|privacy-policy>' => 'page/index',
    'tournament/<slug:[\w-]+>' => 'tournament/view',
    'tournament/<slug:[\w-]+>/rating' => 'tournament/rating',
    'tournament/<slug:[\w-]+>/rule' => 'tournament/rule',
    'tournament/<slug:[\w-]+>/<seria_id:\d+>' => 'tournament/seria',
    'matches/<id:\d+>' => 'matches/view',
    'players/<id:\d+>' => 'players/view',
    'places/<id:\d+>' => 'places/view',
    'media/<slug:[\w-]+>' => 'media/view',

    '<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
    'admin/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'admin/<controller>/<action>',
    'admin/<module:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'admin/<module>/<controller>/<action>'
];