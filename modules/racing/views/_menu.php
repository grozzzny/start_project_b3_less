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
                'label' => Yii::t('rus', 'События'),
                'url' => ['/admin/racing/events'],
                'active' => $controller_id == 'events',
            ],
            [
                'label' => Yii::t('rus', 'Команды'),
                'url' => ['/admin/racing/teames'],
                'active' => $controller_id == 'teames',
            ],
            [
                'label' => Yii::t('rus', 'Рейтинг'),
                'url' => ['/admin/racing/rating'],
                'active' => $controller_id == 'rating',
            ],
            [
                'label' => Yii::t('rus', 'Локации'),
                'url' => ['/admin/racing/locations'],
                'active' => $controller_id == 'locations',
            ],
            [
                'label' => Yii::t('rus', 'Лиги'),
                'url' => ['/admin/racing/league'],
                'active' => $controller_id == 'league',
            ],
        ]
    ])?>
</div>
