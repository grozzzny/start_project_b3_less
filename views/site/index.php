<?php

use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\text\LiveEditText;

/**
 * @var yii\web\View $this
 * @var AdminPages $page
 * @var \app\models\Teames[] $teames
 * @var \app\models\Events[] $events
 */

$this->title = $page->seo->get('title', $page->name);
?>

<?= $this->render('sections/_events', ['models' => $events, 'heading' => LiveEditText::widget([
    'slug' => 'section-events-heading',
    'label' => Yii::t('rus', 'Ближайшие события «{0}»', [Yii::$app->user->selectedLocation->name])])
])?>

<hr class="mb-5 mt-4">

<?= $this->render('sections/_teames', ['models' => $teames, 'heading' => LiveEditText::widget([
    'slug' => 'section-teames-heading',
    'label' => Yii::t('rus', 'Новые команды')])
])?>
