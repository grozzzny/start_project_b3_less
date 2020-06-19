<?php

use grozzzny\admin\modules\pages\models\AdminPages;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
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
