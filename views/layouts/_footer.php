<?php

use grozzzny\admin\modules\social_links\models\AdminSocialLinks;use yii\web\View;

/**
 * @var View $this
 */

?>

<div class="footer py-5 text-center">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <p class="mb-0">
                    <? foreach (AdminSocialLinks::find()->andWhere(['active' => true])->orderBy(['position' => SORT_ASC])->all() as $model): ?>
                        <a title="<?=$model->title?>" href="<?=$model->link?>" class="p-3"><span class="<?=$model->icon?>"></span></a>
                    <? endforeach;?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="mb-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This project developed with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://pr-kenig.ru" target="_blank" >PR-kenig</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</div>
