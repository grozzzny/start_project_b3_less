<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use yii\bootstrap4\LinkPager;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = $page->seo->get('title', $page->name);
?>

<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=$page->liveEditH1?></h1>
        <!--Section description-->

        <div class="text-content">
            <?=$page->liveEditText?>
        </div>

    </section>
</div>

<?= $this->render('../site/sections/_teames', ['models' => $provider->models, 'heading' => null])?>

<div class="container">
    <?= LinkPager::widget([
        'pagination' => $provider->pagination
    ]) ?>
</div>
