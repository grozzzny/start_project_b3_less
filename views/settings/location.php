<?php

use app\models\Locations;
use grozzzny\admin\modules\pages\models\AdminPages;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
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

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name') ?>

            <div class="my-3">
                <?= $this->render('../layouts/_alerts')?>
            </div>

            <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-block btn-yellow']) ?>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>

