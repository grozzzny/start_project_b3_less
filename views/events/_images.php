<?php

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
                            <figure class="col-md-4">
                                <a href="<?=$image->file?>" data-fancybox="group">
                                    <img alt="picture" src="<?=$image->getImage(500)?>" class="img-fluid" />
                                </a>
                            </figure>
                        <? endforeach;?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $("a[data-fancybox]").attr('rel', 'gallery').fancybox({
        loop : true,
        closeClick : false,
        nextEffect : 'none',
        prevEffect : 'none',
        openEffect : 'elastic',
        closeEffect : 'elastic',
        openEasing : 'swing',
        closeEasing : 'swing'
    });
</script>

