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
    <!-- Intro Section -->
    <div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://mdbootstrap.com/img/Photos/Others/model-3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-white-light">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="row pt-5 mt-3">
                    <div class="col-md-12 mb-3">
                        <div class="intro-info-content text-center">
                            <h1 class="display-3 mb-5 wow fadeInDown" data-wow-delay="0.3s">NEW
                                <a class="indigo-text font-weight-bold">COLLECTION</a>
                            </h1>
                            <h5 class="text-uppercase mb-5 mt-1 font-weight-bold wow fadeInDown" data-wow-delay="0.3s">Free
                                delivery & special prices</h5>
                            <a class="btn btn-outline-indigo btn-lg wow fadeInDown" data-wow-delay="0.3s">Shop</a>
                            <a class="btn btn-indigo btn-lg wow fadeInDown" data-wow-delay="0.3s">Lookbook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
