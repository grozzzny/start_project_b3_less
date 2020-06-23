<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\widgets\Menu;

/** @var \Da\User\Model\User $user */
$user = Yii::$app->user->identity;
$module = Yii::$app->getModule('user');
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;

?>


<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?=Yii::t('rus', 'Меню')?></h5>
    </div>
    <?= Menu::widget(
        [
            'options' => [
                'class' => 'list-group list-unstyled list-group-flush',
            ],
            'linkTemplate' => '<a href="{url}" class="list-group-item list-group-item-action list-group-item-light">{label}</a>',
            'items' => [
                [
                    'label' => Yii::t('rus', 'Зарегистрировать команду'),
                    'url' => ['/site/create'],
                    'visible' => empty(Yii::$app->user->identity->team)
                ],
                [
                    'label' => Yii::t('rus', 'Редактировать команду'),
                    'url' => ['/settings/team'],
                    'visible' => !empty(Yii::$app->user->identity->team)
                ],
                [
                    'label' => Yii::t('rus', 'Настройки аккаунта'),
                    'url' => ['/user/settings/account']
                ],
                [
                    'label' => Yii::t('rus', 'Создать локацию'),
                    'url' => ['/settings/location'],
                ],
                [
                    'label' => Yii::t('rus', 'Создать лигу'),
                    'url' => ['/settings/league'],
                ],
                [
                    'label' => Yii::t('rus', 'События'),
                    'url' => ['/settings/events'],
                ],
            ],
        ]
    ) ?>
</div>
