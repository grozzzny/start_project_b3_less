<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeCourts;
use app\modules\office\models\OfficeDocuments;
use app\modules\office\models\Relation;
use app\modules\office\widgets\date_time_picker\DateTimePicker;
use app\modules\office\widgets\select2\Select2;
use grozzzny\admin\widgets\file_input\FileInputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeDocuments */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'relation')->widget(Select2::className(), [
                'data' => OfficeDocuments::relations(),
                'pluginEvents' => ['change' => 'changeRelations'],
            ]) ?>


            <div data-relation="<?= Relation::RELATION_CASE?>">
            <?= $form->field($model, 'case_id')->widget(Select2::className(), [
                'data' => OfficeCase::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>
            </div>
            <div data-relation="<?= Relation::RELATION_CONSULTATION?>">
            <?= $form->field($model, 'consultation_id')->widget(Select2::className(), [
                'data' => OfficeConsultation::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>
            </div>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'category')->widget(Select2::className(), [
                'data' => OfficeDocuments::categories(),
                'pluginEvents' => ['change' => 'changeCategoryDocuments']
            ]) ?>


            <div class="js-category-judicial-act" style="<?= $model->category == OfficeDocuments::CATEGORY_JUDICIAL_ACT ? '' : 'display: none;'?>">
                <?= $form->field($model, 'datetime_act')->widget(DateTimePicker::class)?>

                <?= $form->field($model, 'court_id')->widget(Select2::className(), ['data' => OfficeCourts::map($model->account_id)]) ?>

                <?= $form->field($model, 'category_act')->widget(Select2::className(), ['data' => OfficeDocuments::categoriesAct()]) ?>

                <?= $form->field($model, 'term_appeal')->widget(DateTimePicker::class)?>

                <?= $form->field($model, 'result')->textarea() ?>
            </div>

            <?= $form->field($model, 'file')->widget(FileInputWidget::class, [
                'url' => ['open-file', 'id' => $model->id],
                'urlOptions' => ['target' => '_blank']
            ])?>

            <?= $form->field($model, 'note')->textarea() ?>

        </div>
        <div class="col-md-6">
            <?= $this->render('../_detail_view_account', ['model' => $model])?>

            <?= $this->render('../_detail_view_created', ['model' => $model])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<? Relation::registerJsChangeRelations($model); ?>

<?
$js = <<<JS
    var changeCategoryDocuments = function() {
        var select = $(this),
        box = $(".js-category-judicial-act");

       if(select.val() === 'judicial_act'){
           box.show();
       } else {
           box.hide();
       }
    }
JS;
$this->registerJs($js, View::POS_END);
?>