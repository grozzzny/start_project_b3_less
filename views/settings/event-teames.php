<?php

use app\models\Events;
use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 * @var Events $model
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

            <?= $form->field($model, 'teames_ids')->widget(Select2::className(), [
                'data' => Teames::map(),
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <h1 class="font-weight-bold text-center h1 my-5"><?=Yii::t('rus', 'Заявленные команды')?></h1>

            <table class="table">
                <thead class="warning-color white-text">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?=Yii::t('rus', 'Команда')?></th>
                    <th scope="col"><?=Yii::t('rus', 'Номер телефона')?></th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($model->teames as $i => $team): ?>
                    <tr>
                        <th scope="row"><?=$i+1?></th>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= $team->getImage(50, 50)?>" class="img-fluid z-depth-1 rounded-circle mr-3">
                                <span>
                                 <?= $team->name?>
                            </span>
                            </div>
                        </td>
                        <td><a href="tel:<?=preg_replace('/[^\d+]+/', '', $team->phone)?>"><?= $team->phone?></a></td>
                    </tr>

                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>
</div>

