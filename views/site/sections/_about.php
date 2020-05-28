<?php

use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */

?>


<div class="site-section bg-light" id="about-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3"><?=LiveEditText::widget(['slug' => 'section-about-heading', 'label' => Yii::t('app', 'About Us')])?></h2>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="images/undraw_bookmarks_r6up.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5 ml-auto pl-lg-5">
                <h2 class="text-black mb-4 h3 font-weight-bold"><?=LiveEditText::widget(['slug' => 'section-about-title', 'label' => Yii::t('app', 'Our Mission')])?></h2>
                <p class="mb-4"><?=LiveEditText::widget(['slug' => 'section-about-description', 'label' => Yii::t('app', 'Eos cumque optio dolores excepturi rerum temporibus magni recusandae eveniet, totam omnis consectetur maxime quibusdam expedita dolorem dolor nobis dicta labore quaerat esse magnam unde, aperiam delectus! At maiores, itaque.')])?></p>
                <ul class="ul-check mb-5 list-unstyled success">
                    <li><?=LiveEditText::widget(['slug' => 'section-about-featur-1', 'label' => Yii::t('app', 'Laborum enim quasi at modi')])?></li>
                    <li><?=LiveEditText::widget(['slug' => 'section-about-featur-2', 'label' => Yii::t('app', 'Ad at tempore')])?></li>
                    <li><?=LiveEditText::widget(['slug' => 'section-about-featur-3', 'label' => Yii::t('app', 'Labore quaerat esse')])?></li>
                </ul>
            </div>
        </div>


    </div>
</div>