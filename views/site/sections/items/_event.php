<?php

use app\models\Events;
use yii\web\View;

/**
 * @var View $this
 * @var Events $model
 */

?>


<div class="card card-cascade wider">

    <!-- Card image -->
    <div class="view view-cascade overlay">
        <img class="card-img-top" src="<?=$model->getImage(350, 233)?>" alt="">
        <a href="<?=$model->publicLink?>">
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
        </a>
    </div>

    <!-- Card content -->
    <div class="card-body card-body-cascade text-center pb-0">

        <!-- Title -->
        <h4 class="card-title"><strong><?=$model->name?></strong></h4>
        <!-- Subtitle -->

        <h5 class="red-text pb-2"><strong><?=$model->time_from?></strong></h5>

        <!-- Text -->
        <p class="card-text"><?=$model->descriptionShort?></p>

        <a href="<?=$model->publicLink?>" class="btn btn-outline-black btn-block waves-effect waves-light">
            <? if($model->isOpenRegistration):?>
                <?= Yii::t('rus', 'Подробнее / принять участие')?>
            <? else:?>
                <?= Yii::t('rus', 'Подробнее')?>
            <? endif;?>
        </a>

        <!-- Card footer -->
        <div class="card-footer text-muted text-center mt-4">
            <?=$model->countTimeLabel?>
        </div>

    </div>

</div>
