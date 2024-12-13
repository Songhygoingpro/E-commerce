<?php

session_start();
// require_once '../config/database.php';
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\ProductController;
$controller = new ProductController();
$products = $controller->index();

ob_start();
?>

<section class="hero-banner flex">
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide"><img class="w-full h-full object-cover block"
                    src="./assets/images/t-shirt1__banner.png" alt></div>
            <div class="swiper-slide"><img class="w-full h-full object-cover block"
                    src="./assets/images/t-shirt2__banner.png" alt></div>
            <div class="swiper-slide"><img class="w-full h-full object-cover block"
                    src="./assets/images/t-shirt3__banner.png" alt></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="new-arrival py-20 px-4 space-y-10">
    <div class="new-arrival__title section-title text-center my-0 text-5xl font-bold">New Arrival</div>
    <div class="new-arrival__inner max-w-[1200px] w-full mx-auto">
        <ul class="product-card__items new-arrival__items grid grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($controller->index() as $product): ?>
        <li class="product-card__item flex flex-col gap-4">
            <div class="product-card__image-wrapper">
                <!-- Use a placeholder if product_image is NULL -->
                <img src="<?= $product['product_image'] ? '/e-commerce/' . $product['product_image'] : 'https://via.placeholder.com/100x100' ?>"
                alt="Product" class="max-h-[300px] h-full w-full object-cover rounded-md" />
            </div>
            <div class="product-card__item-content">
                <p class="product-card__item-name font-medium"><?= htmlspecialchars($product['product_title']) ?></p>
                <p class="product-card__item-price">$<?= number_format($product['product_price'], 2) ?></p>
            </div>
        </li>
    <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../app/views/layouts/app.php';
