<?php

use yii\bootstrap4\Alert;
use yii\web\View;

/**
 * @var View $this
 */

$allFlashes = Yii::$app->session->allFlashes;

if(count($allFlashes) == 0) return;
?>

<?php foreach ($allFlashes as $type => $messages) : ?>
    <?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
        <? foreach ($messages as $message) {
                echo Alert::widget([
                    'options' => ['class' => 'alert alert-' . $type . ' show', 'role' => 'alert'],
                    'body' => $message
                ]);
        }?>
    <?php endif ?>
<?php endforeach; ?>