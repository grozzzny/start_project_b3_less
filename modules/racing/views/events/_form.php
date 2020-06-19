<?php

use app\models\Locations;
use app\modules\racing\RacingModule;
use app\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'loaction_id')->widget(Select2::className(), [
        'data' => Locations::map(),
        'bsVersion' => '4',
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => Yii::t('rus', 'Выберите значение'),
        ],
    ]) ?>

    <?= $form->field($model, 'time_from')->widget(DateTimePicker::class)?>

    <?= $form->field($model, 'time_to')->widget(DateTimePicker::class)?>

    <?= $form->field($model, 'active')->checkbox(RacingModule::checkboxSettings()) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
