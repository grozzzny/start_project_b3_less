<?php

use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 * @var string $heading
 * @var Teames[] $models
 */

if(empty($models)) return;
?>


<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
        <? if(!empty($heading)):?>
        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=$heading?></h1>
        <!--Section description-->
        <? endif; ?>
        <div class="row">

            <? foreach ($models as $model):?>
            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4">

                <?= $this->render('items/_team', ['model' => $model])?>

            </div>
            <!--Grid column-->
            <? endforeach; ?>
        </div>

    </section>
</div>
