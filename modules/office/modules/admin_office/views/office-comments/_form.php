<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeComments;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeDocuments;
use app\modules\office\models\OfficeSession;
use app\modules\office\models\OfficeTasks;
use app\modules\office\models\Relation;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeComments */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'relation')->widget(Select2::className(), [
                'data' => OfficeComments::relations(),
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

            <div data-relation="<?= Relation::RELATION_SESSION?>">
                <?= $form->field($model, 'session_id')->widget(Select2::className(), [
                    'data' => OfficeSession::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>

            <div data-relation="<?= Relation::RELATION_CLIENT?>">
                <?= $form->field($model, 'client_id')->widget(Select2::className(), [
                    'data' => OfficeClients::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>

            <div data-relation="<?= Relation::RELATION_TASK?>">
                <?= $form->field($model, 'task_id')->widget(Select2::className(), [
                    'data' => OfficeTasks::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>

            <div data-relation="<?= Relation::RELATION_DOCUMENT?>">
                <?= $form->field($model, 'document_id')->widget(Select2::className(), [
                    'data' => OfficeDocuments::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>


            <?= $form->field($model, 'text')->textarea() ?>
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