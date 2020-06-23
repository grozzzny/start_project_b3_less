<?php

use app\models\Events;
use app\models\League;
use app\models\Locations;
use app\widgets\DateTimePicker;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Events $model
 */

?>


<?php $form = ActiveForm::begin(); ?>

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

<div class="my-3">
    <?= $this->render('../layouts/_alerts')?>
</div>

<?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-block btn-yellow']) ?>

<?php ActiveForm::end(); ?>
