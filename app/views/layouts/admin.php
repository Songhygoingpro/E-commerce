<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Joti+One&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../../public/assets/css/style.css" />
    <style>
        .dashboard-aside {
            min-height: calc(100vh - 65px);
        }
    </style>
</head>

<body>
    <header class="flex justify-between px-6 py-4 bg-gray-300 border-b border-gray-500">
        <div class="logo__wrapper">
            <a href="../../../public" class="text-2xl md:text-3xl font-bold hover:text-gray-700"
                style="font-family: 'Joti One' , serif;">JingHub</a>
        </div><a href="" aria-label="Profile"><i
                class="fa fa-user hover:scale-110 bg-black text-white p-[6px] rounded-full"></i></a>
    </header>
    <main class="grid grid-cols-[auto_1fr] dashboard">
        <aside class="bg-gray-300 w-fit p-8 flex flex-col gap-16 h-full border-r border-gray-500 dashboard-aside">

            <nav>
                <ul class="text-sm font-medium text-gray-700 flex flex-col gap-8">
                    <li>
                        <a href="/e-commerce/app/views/admin/index.php" class="flex gap-4 items-center hover:bg-gray-400 py-2 px-4 w-full"><i class="fa fa-house"></i>
                            <p>Dashboard</p>
                        </a></li>
                    <li class="space-y-5">
                        <h3 class="text-gray-700 text-[12px] font-medium">SUPPORT</h3>
                        <div class="support-links"><a class="flex gap-4 items-center hover:bg-gray-400 py-2 px-4 w-full">
                                <i class="fas fa-user"></i>
                                <p>Agents</p>
                            </a>
                            <a href="/e-commerce/app/views/admin/customers.php" id="customers-link" class="flex gap-4 items-center hover:bg-gray-400 py-2 px-4 w-full">
                                <i class="fas fa-user-group"></i>
                                <p>Customers</p>
                            </a></div>
                    </li>
                    <li class="space-y-5">
                        <h3 class="text-gray-700 text-[12px] font-medium">SHOP</h3>
                        <div class="shop-links">
                            <a href="/e-commerce/app/views/admin/products/" id="products-link"
                                class="flex gap-4 items-center hover:bg-gray-400 py-2 px-4 w-full">
                                <i class="fas fa-folder"></i>
                                <p>Product</p>
                            </a>
                            <a class="flex gap-4 items-center hover:bg-gray-400 py-2 px-4 w-full">
                                <i class="fas fa-bell"></i>
                                <p>Order</p>
                            </a></div>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="section-container">
        <?php echo $content ?>
        </div>
    </main>
    <!-- <script src="../../../../public/assets/js/app.js"></script> -->
</body>

</html>