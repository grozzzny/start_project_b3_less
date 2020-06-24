<?php

use app\models\Events;
use yii\bootstrap4\Alert;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var Events $model
 * @var \grozzzny\admin\components\images\AdminImages[] $images
 */

$this->title = $model->name;
?>

<div class="container my-5 py-5">

    <!--Section: Content-->
    <section class="text-center text-lg-left dark-grey-text">

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-5 mb-4 mb-md-0">

                <!--Image-->
                <div class="view overlay z-depth-1-half">
                    <img src="<?=$model->getImage(781, 521)?>" class="img-fluid" alt="">
                    <div class="mask rgba-white-light"></div>
                </div>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-7 mb-4 mb-md-0">

                <h3 class="font-weight-bold"><?=$model->nameFormat?></h3>

                <h5 class="red-text pb-2"><strong><?=$model->time_from?></strong></h5>

                <p class="text-muted"><?=$model->description?></p>

                <? if(Yii::$app->user->isGuest):?>
                    <?= Alert::widget([
                        'options' => ['class' => 'alert alert-danger'],
                        'body' => Yii::t('rus', 'Чтобы подать заявку на участие, необходимо <a href="{0}">авторизоваться на сайте</a>', [Url::to(['/user/login'])])
                    ])?>
                <? elseif(empty(Yii::$app->user->identity->team)):?>
                    <?= Alert::widget([
                        'options' => ['class' => 'alert alert-danger'],
                        'body' => Yii::t('rus', 'Для участия, необходимо <a href="{0}">зарегистрировать команду</a>', [Url::to(['/site/create'])])
                    ])?>
                <? elseif($model->isOpenRegistration):?>
                    <?if($model->hasTeam(Yii::$app->user->identity->team)): ?>
                        <a class="btn btn-outline-yellow btn-md ml-0" data-method="post" href="<?= Url::to(['/events/delete-team', 'id' => $model->id])?>" role="button">
                            <i class="fas fa-user-minus"></i>
                            <?= Yii::t('rus', 'Отменить заявку')?>
                        </a>
                    <? else:?>
                        <a class="btn btn-yellow btn-md ml-0" data-method="post" href="<?= Url::to(['/events/add-team', 'id' => $model->id])?>" role="button">
                            <i class="fas fa-user-plus"></i>
                            <?= Yii::t('rus', 'Заявиться')?>
                        </a>
                    <? endif;?>
                <? endif;?>

                <hr>

                <?= $this->render('../layouts/_share')?>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </section>
    <!--Section: Content-->

</div>

<? if($model->isEndedEvent):?>
    <?= $this->render('_rating', ['ratings' => $model->getRatings()->orderBy(['value' => SORT_DESC])->all(), 'heading' => Yii::t('rus', 'Результат игры')]) ?>
<? endif;?>


<?if(!Yii::$app->user->isGuest && $model->hasTeam(Yii::$app->user->identity->team)): ?>
    <? if(empty($images)):?>
        <?= $this->render('_form_create_btn')?>
    <? else:?>
        <?= $this->render('_images', ['images' => $images])?>

        <?
        $url_code = Url::to(['/events/code', 'id' => $model->id]);
        $code = $model->code;
        $js = <<<JS
            setInterval(function() {
              $.ajax({
                  type: "POST",
                  url: '$url_code',
                  data: {code:'$code'},
                  success: function(result){
                      if(result === false) window.location.reload();
                  }
              });
            }, 5000);
JS;
        $this->registerJs($js);
        ?>

    <? endif;?>
<? endif;?>



<?= $this->render('../site/sections/_teames', ['models' => $model->teames, 'heading' => Yii::t('rus', 'Заявленные команды')])?>