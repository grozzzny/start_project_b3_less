<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
    
    <?= $this->render('_favicon')?>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--Main Navigation-->
<header>

    <!--Navbar-->
    <?//= $this->render('_navbar')?>

</header>
<!--Main Navigation-->


<!--Main Layout-->
<main>

    <?= $content ?>

</main>
<!--Main Layout-->

<?//= $this->render('_footer')?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
