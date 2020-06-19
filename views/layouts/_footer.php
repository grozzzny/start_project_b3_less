<?php

use grozzzny\admin\modules\social_links\models\AdminSocialLinks;
use grozzzny\admin\modules\text\LiveEditText;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>


<!--Footer-->
<footer class="page-footer pt-4 mt-4 text-center text-md-left grey darken-4">

    <!--Footer Links-->
    <div class="container">
        <div class="row">

            <!--First column-->
            <div class="col-md-3 mr-auto">
                <h5 class="text-uppercase mb-3">STICK-RACING</h5>
                <p class="text-white-50"><?= LiveEditText::widget(['slug' => 'footer-description', 'label' => 'Игра по городскому ориентированию на автомобилях, в погоне за стикерами'])?></p>
                <h5 class="text-uppercase mb-3"><?=Yii::t('rus', 'КОНТАКТЫ')?></h5>
                <p class="text-white-50"><?= LiveEditText::widget(['slug' => 'footer-description-2', 'label' => 'Телефон: <small>+7 (911)</small> 458 71 42 <br>Email: info@stick-racing.ru'])?></p>
            </div>
            <!--/.First column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Second column-->
            <div class="col-md-2 ml-auto">
                <h5 class="text-uppercase mb-3"><?= Yii::t('rus', 'Ссылки')?></h5>
                <ul class="list-unstyled">
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/'])?>">
                            <?= Yii::t('rus', 'Главная')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/events'])?>">
                            <?= Yii::t('rus', 'События')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/teames'])?>">
                            <?= Yii::t('rus', 'Команды')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/rating'])?>">
                            <?= Yii::t('rus', 'Рейтинг')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/rule'])?>">
                            <?= Yii::t('rus', 'Правила')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= Url::to(['/politica'])?>">
                            <?= Yii::t('rus', 'Политика конфиденциальности')?>
                        </a>
                    </li>
                    <li>
                        <a class="text-white-50" href="<?= 'https://vk.com/stickracing' ?>">
                            <?= Yii::t('rus', 'Группа вконтакте')?>
                        </a>
                    </li>
                </ul>
            </div>
            <!--/.Second column-->

            <hr class="w-100 clearfix d-md-none">


            <!--Fourth column-->
            <div class="col-md-5 ml-auto">
                <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
                <!-- VK Widget -->
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 4, wide: 1, no_cover: 1, height: "300"}, 7006567);
                </script>
            </div>
            <!--/.Fourth column-->

        </div>
    </div>
    <!--/.Footer Links-->

    <hr>

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        <div class="container-fluid">
            &copy; <script>document.write(new Date().getFullYear());</script> Copyright:
            <a href="/"> STICK-RACING </a>
            by
            <a href="https://pr-kenig.ru"> PR-kenig </a>

        </div>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->
