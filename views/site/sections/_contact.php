<?php

use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */
?>

<div class="site-section bg-image2 overlay" id="contact-section" style="background-image: url('/images/hero_1.jpg');">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3 text-white"><?=LiveEditText::widget(['slug' => 'section-contact-heading', 'label' => Yii::t('app', 'Contact Us')])?></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-5">
                <?= $this->render('_contact_form')?>
            </div>
        </div>
    </div>
</div>