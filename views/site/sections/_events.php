<?php

use app\models\Events;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 * @var string $heading
 * @var Events[] $models
 */

if(empty($models)) return;
?>

<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=$heading?></h1>
        <!--Section description-->

        <!-- Grid row -->
        <div class="row">

            <? foreach ($models as $model):?>
            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-4">
                <!-- Card Wider -->
                <?= $this->render('items/_event', ['model' => $model])?>
                <!-- Card Wider -->
            </div>
            <!-- Grid column -->
            <? endforeach;?>

        </div>
        <!-- Grid row -->

    </section>
</div>
