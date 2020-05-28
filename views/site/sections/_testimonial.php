<?php

use grozzzny\admin\modules\testimonials\models\AdminTestimonials;
use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */

$models = AdminTestimonials::find()->andWhere(['active' => true])->orderBy(['position' => SORT_ASC])->all();

if(count($models) == 0) return;
?>


<div class="site-section testimonial-wrap" id="testimonials-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3"><?=LiveEditText::widget(['slug' => 'section-testimonial-heading', 'label' => Yii::t('app', 'Testimonials')])?></h2>
            </div>
        </div>
    </div>
    <div class="slide-one-item home-slider owl-carousel">
        <? foreach ($models as $model):?>
        <div>
            <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                    <div><img src="<?= $model->getImage(500, 500) ?>" alt="Image" class="w-100 img-fluid mb-3 shadow"></div>
                </figure>
                <blockquote class="mb-3">
                    <p><?= $model->liveEditDescription ?></p>
                </blockquote>
                <p class="text-black"><strong><?= $model->name ?></strong></p>
            </div>
        </div>
        <? endforeach;?>
    </div>
</div>