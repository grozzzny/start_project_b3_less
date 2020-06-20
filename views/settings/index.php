<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);

?>

<div class="row">
    <div class="col-md-3">
        <div class="my-3">
            <?= $this->render('../user/settings/_menu') ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="my-3">
            <h3 class="h3"><?= $page->liveEditH1 ?></h3>

            <div class="text-content">
                <?= $page->liveEditText ?>
            </div>

        </div>

    </div>
</div>


