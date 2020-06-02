<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 */

?>


<div class="site-blocks-cover" style="overflow: hidden;">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            <div class="col-md-12" style="position: relative;" data-aos="fade-up" data-aos-delay="200">

                <img src="/images/undraw_investing_7u74.svg" alt="Image" class="img-fluid img-absolute">

                <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-6 mr-auto">
                        <h1><?=$page->liveEditH1?></h1>
                        <div class="mb-5"><?=$page->liveEditText?></div>
                        <div>
                            <? if(Yii::$app->user->isGuest):?>
                                <a href="#" class="btn btn-primary mr-2 mb-2"><?=Yii::t('app', 'Get Started')?></a>
                                <a href="<?=Url::to(['/user/login'])?>" class="btn btn-light mr-2 mb-2"><?=Yii::t('app', 'Sign in')?></a>
                            <? else: ?>
                                <a href="<?=Url::to(['/office'])?>" class="btn btn-primary mr-2 mb-2"><?=Yii::t('app', 'Administration')?></a>
                                <a href="<?=Url::to(['/user/logout'])?>" data-method="post" class="btn btn-light mr-2 mb-2"><?=Yii::t('app', 'Sign Out')?></a>
                            <? endif;?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>