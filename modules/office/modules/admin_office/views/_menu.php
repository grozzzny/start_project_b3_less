<?php

use yii\web\View;
use yii\widgets\Menu;

/**
 * @var View $this
 */

$controller_id = Yii::$app->controller->id;

$css = <<<CSS
    .quick-links .active{
        font-weight: bold;
    }
CSS;
$this->registerCss($css);
?>

<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
    <?= Menu::widget([
        'options' => ['class' => 'quick-links'],
        'items' => [
            [
                'label' => Yii::t('rus', 'Аккаунты'),
                'url' => ['/admin/admin_office/office-account'],
                'active' => $controller_id == 'office-account',
            ],
            [
                'label' => Yii::t('rus', 'Сотрудники'),
                'url' => ['/admin/admin_office/office-employee'],
                'active' => $controller_id == 'office-employee',
            ],
            [
                'label' => Yii::t('rus', 'Дела'),
                'url' => ['/admin/admin_office/office-case'],
                'active' => $controller_id == 'office-case',
            ],
            [
                'label' => Yii::t('rus', 'Клиенты'),
                'url' => ['/admin/admin_office/office-clients'],
                'active' => $controller_id == 'office-clients',
            ],

            [
                'label' => Yii::t('rus', 'Консультации'),
                'url' => ['/admin/admin_office/office-consultation'],
                'active' => $controller_id == 'office-consultation',
            ],
            [
                'label' => Yii::t('rus', 'Документы'),
                'url' => ['/admin/admin_office/office-documents'],
                'active' => $controller_id == 'office-documents',
            ],
            [
                'label' => Yii::t('rus', 'Корреспонденция'),
                'url' => ['/admin/admin_office/office-correspondence'],
                'active' => $controller_id == 'office-correspondence',
            ],
            [
                'label' => Yii::t('rus', 'Заседания'),
                'url' => ['/admin/admin_office/office-session'],
                'active' => $controller_id == 'office-session',
            ],
            [
                'label' => Yii::t('rus', 'Задачи'),
                'url' => ['/admin/admin_office/office-tasks'],
                'active' => $controller_id == 'office-tasks',
            ],
            [
                'label' => Yii::t('rus', 'Транзакции'),
                'url' => ['/admin/admin_office/office-transaction'],
                'active' => $controller_id == 'office-transaction',
            ],
            [
                'label' => Yii::t('rus', 'Общий счет'),
                'url' => ['/admin/admin_office/office-accounting'],
                'active' => $controller_id == 'office-accounting',
            ],
        ]
    ])?>
    <?= Menu::widget([
        'options' => ['class' => 'quick-links ml-auto'],
        'items' => [
            [
                'label' => Yii::t('rus', 'Суды'),
                'url' => ['/admin/admin_office/office-courts'],
                'active' => $controller_id == 'office-courts',
            ],
            [
                'label' => Yii::t('rus', 'Комментарии'),
                'url' => ['/admin/admin_office/office-comments'],
                'active' => $controller_id == 'office-comments',
            ],
        ]
    ])?>
</div>
