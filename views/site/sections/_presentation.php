<?php

use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */

?>


<div class="feature-big">
    <div class="container">

        <div class="mt-5 row mb-5 site-section ">
            <div class="col-lg-7 order-1 order-lg-2" data-aos="fade-left">
                <img src="/images/undraw_metrics_gtu7.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5 pr-lg-5 mr-auto mt-5 order-2 order-lg-1">
                <h2 class="text-black"><?=LiveEditText::widget(['slug' => 'section-presentation-heading', 'label' => Yii::t('app', 'Communicate and gather feedback')])?></h2>
                <p class="mb-4"><?=LiveEditText::widget(['slug' => 'section-presentation-description', 'label' => Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem neque nisi architecto autem molestias corrupti officia veniam')])?></p>



                <div class="author-box" data-aos="fade-right">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded-circle">
                        </div>
                        <div class="mr-auto text-black">
                            <strong class="font-weight-bold mb-0"><?=LiveEditText::widget(['slug' => 'section-presentation-name', 'label' => Yii::t('app', 'Kimberly Gush')])?></strong> <br>
                            <?=LiveEditText::widget(['slug' => 'section-presentation-location', 'label' => Yii::t('app', 'Co-Founder, XYZ Inc.')])?>
                        </div>
                    </div>
                    <blockquote>
                        <?=LiveEditText::widget(['slug' => 'section-presentation-quote', 'label' => Yii::t('app', '&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus vitae ipsa asperiores inventore aperiam iure?&rdquo;')])?>
                    </blockquote>
                </div>
            </div>
        </div>

    </div>
</div>