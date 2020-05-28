<?php

use grozzzny\admin\modules\features\models\AdminFeatures;
use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */

$models = AdminFeatures::find()->andWhere(['active' => true])->orderBy(['position' => SORT_ASC])->all();

if(count($models) == 0) return;
?>


<div class="site-section bg-light" id="features-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center"  data-aos="fade-up">
            <div class="col-7 text-center  mb-5">
                <h2 class="section-title"><?=LiveEditText::widget(['slug' => 'section-features-heading', 'label' => Yii::t('app', 'Imagine Features')])?></h2>
                <p class="lead"><?=LiveEditText::widget(['slug' => 'section-features-description', 'label' => Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quos quaerat sapiente nam, id vero.')])?></p>
            </div>
        </div>
        <div class="row align-items-stretch">
            <? foreach ($models as $i => $model): ?>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="<?=$i*100?>">

                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span class="text-primary <?=$model->icon?>"></span></span>
                    </div>
                    <div>
                        <h3><?=$model->liveEditTitle?></h3>
                        <p><?=$model->description?></p>
                    </div>
                </div>
            </div>
            <? endforeach;?>
        </div>
    </div>
</div>