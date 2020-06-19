<?php

use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\web\View;

/**
 * @var View $this
 * @var Teames $model
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);
?>

<?
$page_rule = AdminPages::get('page-rule');
Modal::begin([
    'id' => 'modal-create-team-rule',
    'title' => $page_rule->name,
    'size' => Modal::SIZE_EXTRA_LARGE
]);
    echo $page_rule->liveEditText;
Modal::end();
?>

<div class="text-center">
    <img class="mb-4" src="<?=Yii::$app->params['logo']?>" alt="" style="width: 320px; max-width: 100%;">

    <h1 class="h3 mb-3 font-weight-normal">
        <?=$page->liveEditH1?>
    </h1>
</div>

<div class="text-left">
    <? $form = ActiveForm::begin([
        'options' => ['class' => 'form-create-team form-theme-narrow'],
    ])?>

    <?= $form->field($model, 'email')->textInput(['disabled' => !Yii::$app->user->isGuest])?>

    <?= $form->field($model, 'name')?>

    <?= $form->field($model, 'image')->widget(ImageInputWidget::className()) ?>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" required="required" value="1">
            <?= Yii::t('rus', 'Я ознакомился с <a data-toggle="modal" data-target="#{0}" href="">правилами</a>', ['modal-create-team-rule'])?>
        </label>
    </div>

    <button class="btn btn-lg btn-yellow btn-block" type="submit"><?= Yii::t('rus', 'Зарегистрировать')?></button>

    <? ActiveForm::end()?>
</div>
