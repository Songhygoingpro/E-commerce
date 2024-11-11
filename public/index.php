<?php

session_start();
// require_once '../config/database.php';

ob_start();
?>

<section class="hero-banner flex">
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide"><img class="w-full h-full object-cover block" src="./assets/images/t-shirt1__banner.png" alt></div>
            <div class="swiper-slide"><img class="w-full h-full object-cover block" src="./assets/images/t-shirt2__banner.png" alt></div>
            <div class="swiper-slide"><img class="w-full h-full object-cover block" src="./assets/images/t-shirt3__banner.png" alt></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="new-arrival py-16 px-4">
    <div class="new-arrival__title section-title text-center my-0 text-5xl font-bold">New Arrival</div>
    <div class="new-arrival__inner max-w-[990px w-full">
        <ul class="product-card__items new-arrival__items grid grid-cols-2 lg:grid-cols-4">
            <li class="product-card__item">
                <div class="product-card__image-wrapper"><img src="" alt></div>
                <div class="product-card__item-content">
                    <p class="product-card__item-name"></p>
                    <p class="product-card__item-price"></p>
                </div>
            </li>
            <li class="product-card__item">
                <div class="product-card__image-wrapper"><img src="" alt></div>
                <div class="product-card__item-content">
                    <p class="product-card__item-name"></p>
                    <p class="product-card__item-price"></p>
                </div>
            </li>
            <li class="product-card__item">
                <div class="product-card__image-wrapper"><img src="" alt></div>
                <div class="product-card__item-content">
                    <p class="product-card__item-name"></p>
                    <p class="product-card__item-price"></p>
                </div>
            </li>
            <li class="product-card__item">
                <div class="product-card__image-wrapper"><img src="" alt></div>
                <div class="product-card__item-content">
                    <p class="product-card__item-name"></p>
                    <p class="product-card__item-price"></p>
                </div>
            </li>
        </ul>
    </div>
</section>

<?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../app/views/layout.php';
