<?php

use yii\web\View;

/**
 * @var View $this
 * @var \grozzzny\admin\modules\pages\models\AdminPages $page
 */

?>

<div class="container">

    <h1><?=$page->liveEditH1?></h1>

    <div class="text-content">
        <?=$page->liveEditText?>
    </div>

</div>