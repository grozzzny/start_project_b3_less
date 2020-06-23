<?php

use app\models\Locations;
use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 * @var Locations $model
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

            <p><?= $page->liveEditText ?></p>

            <?= $this->render('_event_form', ['model' => $model])?>

        </div>

    </div>
</div>

