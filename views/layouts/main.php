<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$isMainPage = Yii::$app->controller->route == 'site/index';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= $this->render('_favicon')?>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" class="<?= $isMainPage ? 'main-page' : ''?>">
<?php $this->beginBody() ?>

<!--Main Navigation-->
<header>

    <!--Navbar-->
    <?= $this->render('_navbar')?>

    <? if($isMainPage):?>
    <?= $this->render('../site/sections/_main_section')?>
    <? endif; ?>

</header>
<!--Main Navigation-->


<!--Main Layout-->
<main>

    <?= $content ?>

</main>
<!--Main Layout-->

<?= $this->render('_footer')?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
