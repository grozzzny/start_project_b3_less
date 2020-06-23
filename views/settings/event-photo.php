<?php

use app\models\League;
use app\models\Locations;
use app\models\Teames;
use app\modules\racing\RacingModule;
use app\widgets\DateTimePicker;
use grozzzny\admin\components\images\widget\ImagesWidget;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
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

            <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'disabled' => true]) ?>

            <div class="my-3">
                <?= $this->render('../layouts/_alerts')?>
            </div>

            <?= Html::submitButton(Yii::t('usuario', 'Изменить код'), ['class' => 'btn btn-block btn-yellow']) ?>

            <?php ActiveForm::end(); ?>

            <hr>

            <p><?=Yii::t('rus', 'Загрузите фотографии хорошего качества. Для участников фотографии будут отображаться в хаотичном порядке')?></p>

            <?= ImagesWidget::widget(['model' => $model, 'key' => 'events', 'enable_description' => false, 'enable_author' => false])?>

        </div>

    </div>
</div>

