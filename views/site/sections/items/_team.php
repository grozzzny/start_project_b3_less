<?php

use yii\web\View;

/**
 * @var View $this
 * @var \app\models\Teames $model
 */

?>


<!--Collection card-->
<div class="card collection-card z-depth-1-half item-team">
    <!--Card image-->
    <div class="view zoom">
        <img src="<?=$model->getImage(255, 200)?>" class="img-fluid" alt="">
        <div class="stripe dark">
            <a>
                <p><?=$model->name?></p>
            </a>
        </div>
    </div>
    <!--Card image-->
</div>
<!--Collection card-->
