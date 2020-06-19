<?php

use grozzzny\admin\modules\pages\models\AdminPages;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);
?>

<?= $this->render('sections/_events')?>

<hr class="mb-5 mt-4">

<?= $this->render('sections/_teames')?>
