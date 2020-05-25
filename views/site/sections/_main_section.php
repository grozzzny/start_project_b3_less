<?php

use grozzzny\admin\modules\text\LiveEditText;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>


<div class="site-blocks-cover" style="overflow: hidden;">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            <div class="col-md-12" style="position: relative;" data-aos="fade-up" data-aos-delay="200">

                <img src="/images/undraw_investing_7u74.svg" alt="Image" class="img-fluid img-absolute">

                <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-6 mr-auto">
                        <h1><?=LiveEditText::widget(['slug' => 'section-main-heading', 'label' => Yii::t('app', 'Make Your Business More Profitable')])?></h1>
                        <p class="mb-5"><?=LiveEditText::widget(['slug' => 'section-main-descriprion', 'label' => Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda ea quo cupiditate facere deleniti fuga officia.')])?></p>
                        <div>
                            <a href="#" class="btn btn-primary mr-2 mb-2"><?=Yii::t('app', 'Get Started')?></a>
                            <a href="<?=Url::to(['/site/login'])?>" class="btn btn-light mr-2 mb-2"><?=Yii::t('app', 'Sign in')?></a>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>