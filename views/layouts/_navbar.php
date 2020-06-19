<?php

use app\models\Locations;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>

<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar  navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?= Url::to(['/'])?>">
            <strong>STICK-RACING</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
                aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= Url::to(['/'])?>">
                        <?= Yii::t('rus', 'Главная')?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/events'])?>">
                        <?= Yii::t('rus', 'События')?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/teames'])?>">
                        <?= Yii::t('rus', 'Команды')?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/rating'])?>">
                        <?= Yii::t('rus', 'Рейтинг')?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/rule'])?>">
                        <?= Yii::t('rus', 'Правила')?>
                    </a>
                </li>
            </ul>
            <?= Html::beginForm('/')?>
                <div class="md-form my-0">
                    <?= Select2::widget([
                        'name' => 'location_id',
                        'value' => Yii::$app->user->cookieLocationId,
                        'bsVersion' => '4',
                        'pluginOptions' => [
                            'width' => '200px'
                        ],
                        'size' => Select2::SMALL,
                        'data' => Locations::map(),
                        'pluginEvents' => [
                            'change' => "function() { $(this).parents('form').submit(); }",
                        ]
                    ])?>
                </div>
            <?= Html::endForm();?>
        </div>
    </div>
</nav>
