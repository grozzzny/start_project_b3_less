<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 */
?>


<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=LiveEditText::widget(['slug' => 'section-teames-heading', 'label' => Yii::t('rus', 'Новые команды')])?></h1>
        <!--Section description-->

        <div class="row">

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4">

                <?= $this->render('items/_team')?>

            </div>
            <!--Grid column-->

        </div>

    </section>
</div>
