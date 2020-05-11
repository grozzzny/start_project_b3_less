<?php

use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>

<ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block ml-0 pl-0">
    <li>
        <a href="<?=Url::to(['/', '#' => 'home-section'])?>" class="nav-link"><?= Yii::t('rus', 'Главная')?></a>
    </li>
    <li>
        <a href="<?=Url::to(['/', '#' => 'features-section'])?>" class="nav-link"><?= Yii::t('rus', 'Особенности')?></a>
    </li>
    <li>
        <a href="<?=Url::to(['/', '#' => 'about-section'])?>" class="nav-link"><?= Yii::t('rus', 'О нас')?></a>
    </li>
    <li>
        <a href="<?=Url::to(['/', '#' => 'testimonials-section'])?>" class="nav-link"><?=Yii::t('rus', 'Рекомендации')?></a>
    </li>
    <li>
        <a href="<?=Url::to(['/', '#' => 'contact-section'])?>" class="nav-link"><?=Yii::t('rus', 'Контакты')?></a>
    </li>
</ul>