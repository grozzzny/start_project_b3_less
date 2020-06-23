<?php

use app\models\League;
use app\models\Locations;
use app\models\Rating;
use app\models\Teames;
use app\modules\racing\RacingModule;
use app\widgets\DateTimePicker;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularColumn;
use unclead\multipleinput\TabularInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

/**
 * @var View $this
 * @var AdminPages $page
 * @var Locations $model
 * @var Rating[] $items
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

            <? if(!empty($items)):?>
                <div class="form-group field-events-name required">
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

    </div>
</div>

