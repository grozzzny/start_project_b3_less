<?php
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <div class="container">
        <?= $content ?>
    </div>

<?php $this->endContent(); ?>