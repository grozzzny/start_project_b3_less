<?php

use app\modules\office\models\OfficeAccount;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\web\View;

/**
 * @var View $this
 * @var OfficeAccount $model
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);
?>

<?
$page_offer = AdminPages::get('page-create-account-offer');
Modal::begin([
    'id' => 'modal-create-account-offer',
    'title' => $page_offer->name,
    'size' => Modal::SIZE_EXTRA_LARGE
]);
    echo $page_offer->liveEditText;
Modal::end();
?>

<?
$page_politic = AdminPages::get('page-create-account-politic');
Modal::begin([
    'id' => 'modal-create-account-politic',
    'title' => $page_politic->name,
    'size' => Modal::SIZE_EXTRA_LARGE
]);
    echo $page_politic->liveEditText;
Modal::end();
?>

<div class="text-center">
    <img class="mb-4" src="/images/customer-segmentation.png" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">
        <?=$page->liveEditH1?>
    </h1>
</div>

<div class="text-center">
    <? $form = ActiveForm::begin([
        'options' => ['class' => 'form-create-account form-theme-narrow'],
    ])?>

        <?= $form->field($model, 'email')->textInput(['disabled' => !Yii::$app->user->isGuest])?>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" required="required" value="1">
                <?= Yii::t('rus', 'Я ознакомился с <a data-toggle="modal" data-target="#{0}" href="">публичной офертой</a>', ['modal-create-account-offer'])?>
            </label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" required="required" value="1">
                <?= Yii::t('rus', 'Я согласен с <a data-toggle="modal" data-target="#{0}" href="">политикой обработки персональных данных</a>', ['modal-create-account-politic'])?>
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit"><?= Yii::t('rus', 'Создать')?></button>

        <p class="mt-5 mb-3 text-muted"><?=LiveEditText::widget(['slug' => 'form-create-account-footer', 'label' => Yii::t('rus', 'Будьте готовы взяться за дело с верой, без всяких гарантий успеха. Это признак величия личности.')])?></p>

    <? ActiveForm::end()?>
</div>