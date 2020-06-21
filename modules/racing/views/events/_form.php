<?php

use app\models\League;
use app\models\Locations;
use app\models\Teames;
use app\modules\racing\RacingModule;
use app\widgets\DateTimePicker;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
use grozzzny\admin\components\images\widget\ImagesWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput()
        ->widget(MaskedInput::className(),['mask'=>'99999'])
        ->textInput(['placeholder'=>'_____']);?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'loaction_id')->widget(Select2::className(), [
        'data' => Locations::map(),
        'bsVersion' => '4',
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => Yii::t('rus', 'Выберите значение'),
        ],
    ]) ?>

    <?= $form->field($model, 'league_id')->widget(Select2::className(), [
        'data' => League::map(),
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => Yii::t('rus', 'Выберите значение'),
        ],
    ]) ?>

    <?= $form->field($model, 'time_from')->widget(DateTimePicker::class)?>

    <?= $form->field($model, 'time_to')->widget(DateTimePicker::class)?>

    <?= $form->field($model, 'teames_ids')->widget(Select2::className(), [
        'data' => Teames::map(),
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => Yii::t('rus', 'Выберите значение'),
        ],
    ]) ?>

    <?= $form->field($model, 'active')->checkbox(RacingModule::checkboxSettings()) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?= ImagesWidget::widget(['model' => $model, 'key' => 'events'])?>