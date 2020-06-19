<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;
use yii\authclient\widgets\AuthChoice;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 */
?>

<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(<?=Yii::getAlias('@web/images/43772.jpg')?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-white-light">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row pt-5 mt-3">
                <div class="col-md-12 mb-3">
                    <div class="intro-info-content text-center">
                        <h1 class="display-3 mb-5 wow fadeInDown" data-wow-delay="0.3s">
                            <span class="warning-color font-weight-bold pl-3 pr-3"><?= LiveEditText::widget(['slug' => 'main-section', 'label' => 'STICK-RACING'])?></span>
                        </h1>
                        <h5 class="text-uppercase mb-5 mt-1 font-weight-bold wow fadeInDown" data-wow-delay="0.3s">
                            <?= LiveEditText::widget(['slug' => 'main-section-description', 'label' => 'игра по городскому ориентированию на автомобилях, <br> заключающаяся в поиске стикеров по фотографии'])?>
                        </h5>
                        <? if(Yii::$app->user->isGuest):?>
                            <a href="<?=Url::to(['/site/create'])?>" class="btn btn-outline-yellow btn-lg wow fadeInDown" data-wow-delay="0.3s"><?=Yii::t('rus', 'Создать команду')?></a>
                            <a href="<?=Url::to(['/user/login'])?>" class="btn  btn-yellow btn-lg wow fadeInDown" data-wow-delay="0.3s"><?=Yii::t('app', 'Sign in')?></a>
                        <? else: ?>
<!--                            --><?// if(empty(Yii::$app->user->identity->officeAccount)): ?>
<!--                                <a href="--><?//=Url::to(['/site/create'])?><!--" class="btn btn-primary mr-2 mb-2">--><?//=Yii::t('rus', 'Создать аккаунт')?><!--</a>-->
<!--                            --><?// endif;?>
<!--                            --><?// if(count(Yii::$app->user->identity->officeEmployees) != 0): ?>
<!--                                <a href="--><?//=Url::to(['/office'])?><!--" class="btn btn-success mr-2 mb-2">--><?//=Yii::t('app', 'Administration')?><!--</a>-->
<!--                            --><?// endif;?>
                            <a href="<?=Url::to(['/user/logout'])?>" data-method="post" class="btn  btn-yellow btn-lg wow fadeInDown" data-wow-delay="0.3s"><?=Yii::t('app', 'Sign Out')?></a>
                        <? endif;?>
                        <? if(Yii::$app->user->isGuest):?>
                            <div class="mt-3 auth-block d-flex justify-content-center">
                                <?= AuthChoice::widget([
                                    'baseAuthUrl' => ['/user/security/auth'],
                                    'popupMode' => false,
                                ]) ?>
                            </div>
                        <? endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>