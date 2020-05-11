<?php

use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>

<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-md-3 col-xl-4  d-block">
                <h1 class="mb-0 site-logo"><a href="<?=Url::to(['/'])?>" class="text-black h2 mb-0"><?= Yii::t('rus', 'Журнал судебных дел')?><span class="text-primary">.</span> </a></h1>
            </div>

            <div class="col-12 col-md-9 col-xl-8 main-menu">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <?= $this->render('_menu')?>

                </nav>
            </div>


            <div class="col-6 col-md-9 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
