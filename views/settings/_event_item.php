<?php

use app\models\Events;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Events $model
 */

?>


<div class="card">

    <!-- Card image -->
    <div class="view overlay">
        <img class="card-img-top" src="<?=$model->getImage(350, 233)?>" alt="">
        <div class="mask rgba-white-slight waves-effect waves-light"></div>
    </div>

    <!-- Card content -->
    <div class="card-body text-center pb-0">

        <!-- Title -->
        <h4 class="card-title"><strong><?=$model->name?></strong></h4>
        <!-- Subtitle -->

        <h5 class="red-text pb-2"><strong><?=$model->time_from?></strong></h5>

        <? if($model->isOpenEdit):?>
        <a href="<?=Url::to(['/settings/event-edit', 'id' => $model->id])?>" class="btn btn-outline-black btn-block waves-effect waves-light mb-2">
            <?= Yii::t('rus', 'Изменить')?>
        </a>
        <a href="<?=Url::to(['/settings/event-rating', 'id' => $model->id])?>" class="btn btn-outline-black btn-block waves-effect waves-light mb-2">
            <?= Yii::t('rus', 'Редактировать результаты')?>
        </a>
        <a href="<?=Url::to(['/settings/event-photo', 'id' => $model->id])?>" class="btn btn-outline-black btn-block waves-effect waves-light mb-2">
            <?= Yii::t('rus', 'Фотографии')?>
        </a>
        <? endif;?>

        <? if($model->isOpenRegistration):?>
        <a href="<?=Url::to(['/settings/event-teames', 'id' => $model->id])?>" class="btn btn-outline-black btn-block waves-effect waves-light mb-2">
            <?= Yii::t('rus', 'Заявки')?>
        </a>
        <a href="<?=Url::to(['/settings/event-delete', 'id' => $model->id])?>" class="btn btn-outline-black btn-block waves-effect waves-light mb-2">
            <?= Yii::t('rus', 'Удалить')?>
        </a>
        <? endif;?>

        <a href="<?=$model->publicLink?>" class="btn btn-outline-black btn-block waves-effect waves-light" target="_blank">
            <?= Yii::t('rus', 'Посмотреть как видят все')?>
        </a>

    </div>

    <!-- Card footer -->
    <div class="card-footer text-muted text-center mt-4">
        <?=$model->countTimeLabel?>
    </div>

</div>
