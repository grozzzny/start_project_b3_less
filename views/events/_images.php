<?php

use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var \grozzzny\admin\components\images\AdminImages[] $images
 */

if(empty($images)) return;
shuffle($images);

$this->registerAssetBundle(grozzzny\depends\fancybox\FancyboxAsset::class);
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Yii::t('rus', 'Фото к игре')?></h5>

            <div class="row">
                <div class="col-md-12">

                    <div id="mdb-lightbox-ui"></div>

                    <div class="mdb-lightbox no-margin row">

                        <? foreach ($images as $image):?>
                            <figure class="col-md-4 js-block-image">
                                <a href="<?=$image->file?>" data-fancybox="group">
                                    <img alt="picture" src="<?=$image->getImage(500)?>" class="img-fluid" />
                                </a>
                                <button class="btn btn-outline-black btn-block waves-effect waves-light mb-2 js-hidden-image">
                                    <?= Yii::t('rus', 'Скрыть')?>
                                </button>
                            </figure>
                        <? endforeach;?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?
$js = <<<JS
    (function() {
      $('.js-hidden-image').on('click', function() {
         $(this).parents('.js-block-image').remove();
      });
    })();
JS;
$this->registerJs($js);
?>

