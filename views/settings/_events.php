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

<!-- Grid row -->
<div class="row">

    <? foreach ($models as $model):?>
    <!-- Grid column -->
    <div class="col-lg-6 col-md-12 mb-4">
        <!-- Card Wider -->
        <?= $this->render('_event_item', ['model' => $model])?>
        <!-- Card Wider -->
    </div>
    <!-- Grid column -->
    <? endforeach;?>

</div>
<!-- Grid row -->