<?php

use yii\web\View;

/**
 * @var View $this
 */

?>

<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-md-3 col-xl-4  d-block">
                <h1 class="mb-0 site-logo"><a href="index.html" class="text-black h2 mb-0">imagine<span class="text-primary">.</span> </a></h1>
            </div>

            <div class="col-12 col-md-9 col-xl-8 main-menu">
                <nav class="site-navigation position-relative text-right" role="navigation">

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
                </nav>
            </div>


            <div class="col-6 col-md-9 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
