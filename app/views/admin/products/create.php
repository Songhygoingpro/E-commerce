<?php

session_start();
// require_once '../config/database.php';

ob_start();
?>
<section class="products-new py-10 px-16 flex flex-col gap-6 bg-[#E0E0E0] h-full w-full">
    <h1 class="text-2xl font-bold">Add Product</h1>
    <div class="products-new__inner grid max-w-[950px] w-full">
        <form class="grid grid-cols-[auto_auto] gap-4 w-full" action="" method="post">
            <div class="product-details grid gap-4">
                <div class="product-info border border-gray-400 bg-gray-300 rounded-md p-4 grid gap-4">
                    <div class="product-title flex flex-col gap-2">
                        <h3 class="text-sm">Title</h3>
                        <input
                            class="rounded-md border border-gray-500 indent-4 bg-gray-300 text-sm placeholder:text-sm box-border py-[6px]"
                            placeholder="Short sleeve t-shirt" type="text" name="product-title">
                    </div>
                    <div class="product-description flex flex-col gap-2">
                        <h3 class="text-sm">Description</h3>
                        <textarea
                            class="rounded-md border border-gray-500 indent-4 bg-gray-300 resize-none text-sm placeholder:text-sm box-border py-[6px]"
                            type="text" name="product-description" rows="5"></textarea>
                    </div>
                    <div class="product-media flex flex-col gap-2">
                        <h3 class="text-sm">Media</h3>
                        <div class="relative border-2 border-dashed border-gray-500 rounded-lg cursor-pointer">
                            <input type="file" id="fileInput" class="absolute w-full h-full opacity-0 cursor-pointer"
                                accept="image/*">
                            <div class="p-4 text-center">

                                <p class="mt-2 text-sm text-gray-500">Upload new</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-category flex flex-col gap-2">
                        <h3 class="text-sm">Category</h3>
                        <input
                            class="rounded-md bg-gray-300 border border-gray-500 placeholder:text-sm text-sm indent-4 py-[6px]"
                            type="text" name="product-category">
                    </div>
                </div>
                <div class="product-pricing border border-gray-400 bg-gray-300 rounded-md p-4 grid gap-4">
                    <h3 class="text-sm">Pricing</h3>
                    <div class="product-priceNsale flex gap-4">
                        <div class="product-price flex flex-col gap-2">
                            <h4 class="text-xs">Price</h4> <input
                                class="rounded-md border border-gray-500 indent-4 bg-gray-300 text-sm placeholder:text-sm box-border py-[6px]"
                                type="text" name="product-price" placeholder="$0.00">
                        </div>
                        <div class="product-compareAtPrice flex flex-col gap-2">
                            <h4 class="text-xs">Compare-at price</h4> <input
                                class="rounded-md border border-gray-500 indent-4 bg-gray-300 text-sm placeholder:text-sm box-border py-[6px]"
                                type="text" name="product-price" placeholder="$0.00">
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-meta">
                <div class="product-status border border-gray-500 rounded-md bg-gray-300 p-4 grid gap-4">
                    <h3 class="text-sm">Status</h3>
                    <div class="grid items-center">
                        <select class="appearance-none row-start-1 col-start-1 bg-gray-300 border-gray-500 border px-4 rounded-md py-[6px]">
                            <option>Yes</option>
                            <option>No</option>
                            <option>Maybe</option>
                        </select>
                        <!-- <svg class="pointer-events-none row-start-1 mr-4 col-start-1 justify-self-end" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="8 10 12 6 16 10"></polyline>
                            <polyline points="16 14 12 18 8 14"></polyline>
                        </svg> -->
                        <svg class="pointer-events-none row-start-1 mr-4 col-start-1 justify-self-end w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8.884 2.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.749.749 0 1 0 1.06 1.06l2.47-2.47 2.47 2.47a.749.749 0 1 0 1.06-1.06z"></path><path d="m11.53 11.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.749.749 0 1 1 1.06-1.06l2.47 2.47 2.47-2.47a.749.749 0 1 1 1.06 1.06"></path></svg>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../../layouts/admin.php';
