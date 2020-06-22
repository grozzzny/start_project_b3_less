<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 * @var array $arr_ratings
 */

$this->title = $page->seo->get('title', $page->name);
?>

<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=$page->liveEditH1?> «<?= Yii::$app->user->selectedLocation->name?>»</h1>
        <!--Section description-->

        <div class="text-content">
            <?=$page->liveEditText?>
        </div>

    </section>
</div>

<? foreach ($arr_ratings as $data):?>
    <?= $this->render('../events/_rating', [
        'ratings' => ArrayHelper::getValue($data, 'models', []),
        'heading' => ArrayHelper::getValue($data, 'name')
    ])?>
<? endforeach;?>
