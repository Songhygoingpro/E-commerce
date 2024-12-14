<?php

session_start();
require_once '../../../../vendor/autoload.php';
use App\Controllers\ProductController;
$controller = new ProductController();
$product_title = $_GET['product_title'];
$product = $controller->edit($product_title);

ob_start();
?>
<section class="products-new py-10 px-16 flex flex-col items-center gap-6 bg-[#F1F1F1] h-full w-auto">

    <div class="products-new__inner grid gap-6 max-w-[950px] w-full">
        <h1 class="text-2xl font-bold self-start flex gap-2"><a href="/e-commerce/app/views/admin/products/index.php">
                <img class="w-8 h-auto" src="/e-commerce/public/assets/images/left-arrow-icon.png"
                    alt=""></a><?= $product['product_title'] ?></h1>
        <form class="grid gap-4" action="<?php $controller->update(); ?>" method="post" enctype="multipart/form-data">
            <input class="hidden" type="text" name="action" value="update">
            <div class="form__inner grid grid-cols-[auto_auto] gap-4 w-full">
                <input type="text" value="<?= $product['product_id'] ?>" name="product-id" class="hidden">
                <div class="product-details grid gap-4">
                    <div class="product-info border border-gray-400 bg-[#F1F1F1] rounded-md p-4 grid gap-4">
                        <div class="product-title flex flex-col gap-2">
                            <label for="product-title" class="text-sm">Title</label>
                            <input
                                class="rounded-md border border-gray-500 indent-4 focus:bg-gray-300 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                placeholder="Short sleeve t-shirt" type="text" id="product-title" name="product-title"
                                value="<?= $product['product_title'] ?>">
                        </div>
                        <div class="product-description flex flex-col gap-2">
                            <label for="product-description" class="text-sm">Description</label>
                            <textarea
                                class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] resize-none text-sm placeholder:text-sm box-border py-[6px]"
                                type="text" name="product-description" id="product-description" rows="5"
                                value="<?= $product['product_description'] ?>"></textarea>
                        </div>
                        <div class="product-media flex flex-col gap-2">
                            <label for="product-media" id="img-upload-button" class="text-sm">Media</label>
                            <div class="relative border-2 border-dashed border-gray-500 rounded-lg cursor-pointer">
                                <input type="file" id="file-input" name="product-media"
                                    class="absolute w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                <div class="p-4 text-center">
                                    <p class="mt-2 text-sm text-gray-500">Upload new</p>
                                </div>
                            </div>
                            <div id="image-preview" class="">
                                <div class="flex gap-4 items-center">
                                    <input class="hidden" type="text" name="product-image"
                                        value="<?= $product['product_image'] ?>">
                                    <img id="uploaded-image" src="/e-commerce/<?= $product['product_image'] ?>"
                                        alt="Cover Image" class="max-w-40 h-auto">
                                    <div id="loader" class="hidden">Loading...</div>
                                    <button
                                        class="px-4 py-2 border-2 border-gray-400 rounded-md text-center font-semibold"
                                        id="change-image-button" type="button">Change</button>
                                    <button type="button" class="text-red-500 font-semibold"
                                        id="remove-image-button">Remove</button>
                                </div>
                            </div>
                        </div>

                        <div class="product-category flex flex-col gap-2">
                            <label for="product-category" class="text-sm">Category</label>
                            <div class="grid items-center custom-select">
                                <select
                                    class="appearance-none row-start-1 col-start-1 bg-[#F1F1F1] border-gray-500 border px-4 rounded-md py-[6px]"
                                    name="product-category" id="product-category">
                                    <option value="" hidden></option>
                                    <option value="Shirts & Tops">Shirts & Tops</option>
                                    <option value="Pants">Pants</option>
                                    <option value="Shorts">Shorts</option>
                                    <option value="Dresses">Dresses</option>
                                    <option value="Skirts">Skirts</option>
                                </select>
                                <svg class="pointer-events-none row-start-1 mr-4 col-start-1 justify-self-end w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path
                                        d="M8.884 2.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.749.749 0 1 0 1.06 1.06l2.47-2.47 2.47 2.47a.749.749 0 1 0 1.06-1.06z">
                                    </path>
                                    <path
                                        d="m11.53 11.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.749.749 0 1 1 1.06-1.06l2.47 2.47 2.47-2.47a.749.749 0 1 1 1.06 1.06">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="product-pricing border border-gray-400 bg-[#F1F1F1] rounded-md p-4 grid gap-4">
                        <h3 class="text-sm">Pricing</h3>
                        <div class="product-priceNsale flex gap-4">
                            <div class="product-price flex flex-col gap-2">
                                <label for="product-price" class="text-xs">Price</label> <input
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="number" name="product-price" id="product-price" placeholder="$0.00"
                                    value="<?= $product['product_price'] ?>">
                            </div>
                            <div class="product-compareAtPrice flex flex-col gap-2">
                                <label for="product-compareAtPrice" class="text-xs">Compare-at price</label> <input
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="number" name="product-compareAtPrice" id="product-compareAtPrice"
                                    placeholder="$0.00">
                            </div>
                        </div>
                        <div class="product-profit-calculation flex gap-4">
                            <div class="product-cost flex flex-col gap-2">
                                <label for="product-cost" class="text-xs">Cost per item</label> <input
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="number" name="product-cost" id="product-cost" placeholder="$0.00">
                            </div>
                            <div class="product-profit flex flex-col gap-2">
                                <label for="product-profit" class="text-xs">Profit</label> <input readonly
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="text" name="product-profit" id="product-profit" placeholder="$0.00">
                            </div>
                            <div class="product-margin flex flex-col gap-2">
                                <label for="product-margin" class="text-xs">Margin</label> <input readonly
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="text" name="product-margin" id="product-margin" placeholder="$0.00">
                            </div>
                        </div>
                    </div>
                    <div class="product-inventory border border-gray-400 bg-[#F1F1F1] rounded-md p-4 grid gap-4">
                        <h3 class="text-sm">Inventory</h3>
                        <div class="product-quantity flex gap-4">
                            <div class="product-quantity flex flex-col gap-2">
                                <label for="product-quantity" class="text-xs">Quantity</label> <input
                                    class="rounded-md border border-gray-500 indent-4 bg-[#F1F1F1] text-sm placeholder:text-sm box-border py-[6px]"
                                    type="number" name="product-quantity" id="product-quantity" placeholder=""
                                    value="<?= $product['stock_quantity'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-meta">
                    <div class="product-status border border-gray-500 rounded-md bg-[#F1F1F1] p-4 grid gap-4">
                        <h3 class="text-sm">Status</h3>
                        <div class="grid items-center custom-select">
                            <select
                                class="appearance-none row-start-1 col-start-1 bg-[#F1F1F1] border-gray-500 border px-4 rounded-md py-[6px]"
                                name="status">
                                <option value="">Yes</option>
                                <option value="">No</option>
                                <option value="">Maybe</option>
                            </select>
                            <svg class="pointer-events-none row-start-1 mr-4 col-start-1 justify-self-end w-4 h-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path
                                    d="M8.884 2.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.749.749 0 1 0 1.06 1.06l2.47-2.47 2.47 2.47a.749.749 0 1 0 1.06-1.06z">
                                </path>
                                <path
                                    d="m11.53 11.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.749.749 0 1 1 1.06-1.06l2.47 2.47 2.47-2.47a.749.749 0 1 1 1.06 1.06">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-actionBtns flex justify-end gap-2">
                <button
                    class="delete-button bg-red-600 hover:bg-red-800 justify-self-end transition-color text-white font-medium rounded-lg text-sm px-4 py-2"
                    type="button" onclick="toggleDeleteModal()">Delete product</button>
                <button
                    class="save-button justify-self-end transition-color text-white font-medium rounded-lg text-sm px-4 py-2"
                    type="submit">Save</button>
            </div>
        </form>
        <!-- Modal Background -->
        <div
            class="confirm-product-delete__modal fixed inset-0 bg-black hidden justify-center items-center bg-opacity-50 z-50">
            <!-- Modal Container -->
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Delete <?= $product['product_title'] ?>?</h2>
                    <button class="text-gray-500 hover:text-gray-700" onclick="toggleDeleteModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <p class="text-sm text-gray-600 mb-6">
                    If you delete <span class="font-bold"><?= $product['product_title'] ?></span>, this can’t be undone.
                    Any media that’s only used by this product will also be deleted.
                </p>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4">
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200"
                        onclick="toggleDeleteModal()">
                        Cancel
                    </button>
                    <form action="<?php $controller->destroy($product['product_id']) ?>" method="post"
                        enctype="multiplart/form-data">
                        <input class="hidden" type="text" name="action" value="destroy">
                        <button
                            class="bg-red-600 hover:bg-red-800 justify-self-end transition-color text-white font-medium rounded-lg text-sm px-4 py-2"
                            type="submit">Delete product</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
        const ConfirmDeleteModal = document.querySelector(".confirm-product-delete__modal");

        function toggleDeleteModal() {
            ConfirmDeleteModal.classList.toggle("hidden");
            ConfirmDeleteModal.classList.toggle("flex");
        }


</script>

<?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../../layouts/admin.php';
