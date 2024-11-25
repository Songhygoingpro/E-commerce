<?php
$logedIn = isset($_SESSION["logedIn"]) ? $_SESSION["logedIn"] : false;
$signedUp = isset($_SESSION["signedUp"]) ? $_SESSION["signedUp"] : false;
$is_admin =  isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'JingHub' ?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Joti+One&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../public/assets/css/style.css" />
</head>

<body>
    <header class="bg-black text-white flex justify-around items-center py-4 px-5 md:px-6">
        <nav>
            <ul class="flex gap-4 font-medium">
                <li><a href="" class="text-sm hover:opacity-80">STORE</a></li>
                <li><a href="" class="text-sm hover:opacity-80">COLLECTIONS</a></li>
                <li><a href="" class="text-sm text-red-600 hover:opacity-80">SALE</a></li>
                <?php
                echo $is_admin == 1 ? '<li><a href="../app/views/admin/" class="text-sm hover:opacity-80">DASHBOARD</a></li>' : '';
                ?>
            </ul>
        </nav>
        <div class="logo__wrapper">
            <a href="#" class="text-2xl md:text-3xl font-bold hover:text-gray-300" style="font-family: 'Joti One' , serif;">JingHub</a>
        </div>
        <div class="header-actions flex gap-4">
            <button class="search-btn"><i class="fa fa-search hover:scale-110"></i></button>
            <button class="shop-btn"><i class="fa fa-shopping-cart hover:scale-110"></i></button>
            <?php if ($logedIn || $signedUp): ?>
                <a href="" aria-label="Profile"><i class="fa fa-user hover:scale-110 border p-[5px] rounded-full"></i></a>
            <?php else: ?>
                <a href="../app/views/auth/login.php" class="login-btn font-medium">Login</a>
            <?php endif ?>
        </div>
    </header>
    <main><?php echo $content ?></main>
    <footer class="bg-black grid gap-4 pt-4">
        <div class="payment-acception flex justify-center"><img class="h-6 w-auto" src="/public/assets/images/payment-acception.png" alt></div>
        <div class="w-full text-center py-2 px-6 border-t">
            <p class="text-white">&copy; <?php echo date('Y') ?> power by JingHub</p>
        </div>
    </footer>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            slidesPerView: 1.5,
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 1000,
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 15,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script src="/public/assets/js/script.js"></script>
</body>

</html>