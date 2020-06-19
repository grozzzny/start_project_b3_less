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
        <h1 class="font-weight-bold text-center h1 my-5"><?=LiveEditText::widget(['slug' => 'section-events-heading', 'label' => Yii::t('rus', 'Ближайшие события «{0}»', [Yii::$app->user->selectedLocation->name])])?></h1>
        <!--Section description-->

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-4">
                <!-- Card Wider -->
                <?= $this->render('items/_event')?>
                <!-- Card Wider -->
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </section>
</div>
