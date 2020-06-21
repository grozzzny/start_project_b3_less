<?php

use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $label
 */
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Yii::t('rus', 'Фото к игре')?></h5>

            <p class="card-text"><?= Yii::t('rus', 'Для просмотра фотографий, необходимо ввести код, который вам сообщат на старте')?></p>

            <?= Html::beginForm(null, 'POST', ['class' => 'form-create-btn']) ?>

            <?= Html::input('number', 'code', /*Yii::$app->request->get('code')*/null) ?>

            <button type="submit" class="btn btn-yellow btn-md ml-0" role="button">
                <i class="fas fa-user-minus"></i>
                <?= Yii::t('rus', 'Показать фотографии')?>
            </button>

            <? Html::endForm(); ?>
        </div>
    </div>

</div>

