<?php

use grozzzny\admin\modules\pages\models\AdminPages;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);
?>

<?= $this->render('sections/_main_section', ['page' => $page])?>
<!---->
<?//= $this->render('sections/_features')?>
<!---->
<?//= $this->render('sections/_presentation')?>
<!---->
<?//= $this->render('sections/_about')?>
<!---->
<?//= $this->render('sections/_testimonial')?>
<!---->
<?//= $this->render('sections/_contact')?>