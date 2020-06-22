<?php

/**
 * @var yii\web\View $this
 * @var \app\models\Events $model
 */
?>

<div class="container">
    <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

        <!--Section heading-->
        <h1 class="font-weight-bold text-center h1 my-5"><?=Yii::t('rus', 'Рейтинг')?></h1>
        <!--Section description-->

        <table class="table">
            <thead class="warning-color white-text">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?=Yii::t('rus', 'Команда')?></th>
                <th scope="col"><?=Yii::t('rus', 'Стикеры')?></th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($model->getRatings()->orderBy(['value' => SORT_DESC])->all() as $i => $rating): ?>
                <tr>
                    <th scope="row"><?=$i+1?></th>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= $rating->team->getImage(50, 50)?>" class="img-fluid z-depth-1 rounded-circle mr-3">
                            <span>
                                 <?= $rating->team->name?>
                            </span>
                        </div>
                    </td>
                    <td><?= $rating->value?></td>
                </tr>

            <? endforeach; ?>
            </tbody>
        </table>

    </section>
</div>
