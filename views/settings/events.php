<?php

use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var AdminPages $page
 * @var \yii\data\ActiveDataProvider $provider
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

            <a href="<?=Url::to(['/settings/event-create'])?>" class="btn btn-outline-yellow btn-block waves-effect waves-light mb-5">
                <?= Yii::t('rus', 'Создать событие')?>
            </a>

            <?= $this->render('_events', ['models' => $provider->models, 'heading' => null])?>

        </div>

    </div>
</div>

<div class="container">
    <?= LinkPager::widget([
        'pagination' => $provider->pagination
    ]) ?>
</div>
