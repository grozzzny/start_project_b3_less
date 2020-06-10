<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeDocuments;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\models\OfficeTasks;
use app\modules\office\models\Relation;
use app\modules\office\modules\admin_office\AdminOfficeModule;
use app\modules\office\widgets\date_time_picker\DateTimePicker;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeTasks */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'relation')->widget(Select2::className(), [
                'data' => OfficeTasks::relations(),
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

            <?= $form->field($model, 'curator_id')->widget(Select2::className(), [
                'data' => OfficeEmployee::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'time_to')->widget(DateTimePicker::class)?>

            <?= $form->field($model, 'type_priority')->widget(Select2::className(), ['data' => OfficeTasks::priorities()]) ?>

            <?= $form->field($model, 'confirmed')->checkbox(AdminOfficeModule::checkboxSettings()) ?>
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