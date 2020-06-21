<?php
use yii\web\View;

/**
 * @var View $this
 */

$css = <<<CSS
    .ya-share2__icon {
        height: 40px !important;
        width: 40px !important;
        background-size: auto !important;
    }
CSS;
$this->registerCss($css);

?>
<div class="full-news-share-buttons mb">
    <span class="full-news-share-label"><?=Yii::t('rus', 'Поделиться')?>:</span>
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <div class="ya-share2" data-size="m" data-services="vkontakte,facebook,viber,whatsapp,telegram"></div>
</div>