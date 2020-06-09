<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\widgets\select2\Select2;
use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $label
 */

$css = <<<CSS
    .form-create-btn .select2-container{
        width: initial !important;
    }
CSS;
$this->registerCss($css);
?>

<?= Html::beginForm(['create'], 'GET', ['class' => 'form-create-btn']) ?>

<?= Select2::widget([
    'name' => 'account_id',
    'value' => Yii::$app->request->get('account_id'),
    'data' => OfficeAccount::map(),
    'addon' => [
        'append' => [
            'content' => Html::submitButton($label, ['class' => 'btn btn-primary']),
            'asButton' => true
        ]
    ]
])?>

<? Html::endForm(); ?>