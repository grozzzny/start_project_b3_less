<?php

use app\models\League;
use app\models\Locations;
use app\models\Rating;
use app\models\Teames;
use app\modules\league\models\Series;
use app\modules\racing\RacingModule;
use app\widgets\DateTimePicker;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
use grozzzny\admin\components\images\widget\ImagesWidget;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularColumn;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var Rating[] $items */
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


    <? if(!empty($items)):?>
        <div class="form-group field-events-name required">
            <label for="events-name"><?= Yii::t('rus', 'Рейтинг')?></label>
            <?= TabularInput::widget([
                'id' => 'multiple-input',
                'models' => $items,
                'form' => $form,
//                        'attributeOptions' => [
//                            'enableAjaxValidation'      => true,
//                            'enableClientValidation'    => false,
//                        ],
                'min' => count($items),
                'max' => count($items),
                'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                //'sortable' => true,
                'enableError' => true,
                'cloneButton' => false,
                'columns' => [
                    [
                        'name' => 'id',
                        'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                    ],
                    [
                        'name' => 'team_id',
                        'options' => [
                            'disabled' => true
                        ],
                        'value' => function($model) {
                            /** @var Rating $model */
                            return $model->team->name;
                        },
                        'title' => Yii::t('rus', 'Команда')
                    ],
                    [
                        'name' => 'value',
                        'title' => Yii::t('rus', 'Стикеров')
                    ]
                ]
            ]);
            ?>
        </div>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?= ImagesWidget::widget(['model' => $model, 'key' => 'events'])?>