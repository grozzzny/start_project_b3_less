<?php

use app\models\User;
use app\modules\racing\RacingModule;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Teames */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="teames-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'owner_id')->widget(Select2::className(), [
        'data' => User::map(),
        'bsVersion' => '4',
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => Yii::t('rus', 'Выберите значение'),
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'phone')
        ->widget(MaskedInput::className(),['mask'=>'+7 999 999-99-99'])
        ->textInput(['placeholder'=>'+7 ___ ___-__-__']);?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <?= $form->field($model, 'active')->checkbox(RacingModule::checkboxSettings()) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
