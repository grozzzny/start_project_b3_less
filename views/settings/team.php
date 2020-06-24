<?php

use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

/**
 * @var View $this
 * @var AdminPages $page
 * @var Teames $model
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

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model,'phone')
                ->widget(MaskedInput::className(),['mask'=>'+7 999 999-99-99'])
                ->textInput(['placeholder'=>'+7 ___ ___-__-__']);?>

            <div class="my-3">
                <?= $this->render('../layouts/_alerts')?>
            </div>

            <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-block btn-yellow']) ?>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>

