<?php

use yii\web\View;

/**
 * @var View $this
 */

?>

<ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block ml-0 pl-0">
    <li><a href="#home-section" class="nav-link">Home</a></li>
    <li><a href="#features-section" class="nav-link">Features</a></li>
    <li class="has-children">
        <a href="#about-section" class="nav-link">About Us</a>
        <ul class="dropdown arrow-top">
            <li><a href="#" target="_blank" class="nav-link"><span class="text-primary">More Free Templates</span></a></li>
            <li><a href="#our-team-section" class="nav-link">Our Team</a></li>
            <li class="has-children">
                <a href="#">More Links</a>
                <ul class="dropdown">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>
    <li><a href="#blog-section" class="nav-link">Blog</a></li>
    <li><a href="#contact-section" class="nav-link">Contact</a></li>
</ul>