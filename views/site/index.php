<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 */

$this->title = $page->seo->get('title', $page->name);
?>