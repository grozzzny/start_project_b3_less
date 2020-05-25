<?php

use grozzzny\admin\modules\text\LiveEditText;
use yii\web\View;

/**
 * @var View $this
 */

?>


<div class="site-section bg-image2 overlay" id="contact-section" style="background-image: url('images/hero_1.jpg');">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3 text-white"><?=LiveEditText::widget(['slug' => 'section-contact-heading', 'label' => Yii::t('app', 'Contact Us')])?></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-5">



                <form action="#" class="p-5 bg-white">

                    <h2 class="h4 text-black mb-5">Contact Form</h2>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="fname">First Name</label>
                            <input type="text" id="fname" class="form-control rounded-0">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="lname">Last Name</label>
                            <input type="text" id="lname" class="form-control rounded-0">
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-md-12">
                            <label class="text-black" for="email">Email</label>
                            <input type="email" id="email" class="form-control rounded-0">
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-md-12">
                            <label class="text-black" for="subject">Subject</label>
                            <input type="subject" id="subject" class="form-control rounded-0">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="7" class="form-control rounded-0" placeholder="Leave your message here..."></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Send Message" class="btn btn-primary mr-2 mb-2">
                        </div>
                    </div>


                </form>
            </div>

        </div>

    </div>
</div>