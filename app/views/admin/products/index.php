<?php

session_start();
// require_once '../config/database.php';

ob_start();
?>
        <section class="products py-10 px-16 flex flex-col gap-6 bg-[#E0E0E0] h-full w-full">
        <h1 class="text-2xl lg:text-3xl font-bold ">Product</h1>
        <div class="products__inner w-full space-y-4 h-full flex flex-col">
            <div class="flex justify-between"><input class="border border-gray-600 rounded-md indent-4 placeholder:text-sm" placeholder="Search for product" type="text" name="" id=""><a href="create.php" class="bg-black text-white text-center px-6 py-2 rounded-md">Add new product</a></div>
            <div class="products-board border-2 border-black flex flex-col rounded-md w-full h-full">
                <div class="product-sort bg-white w-full p-4 border-b border-black flex gap-6">
                    <button>All</button><button>Active</button>
                </div>
                <div class="products-info w-full">
                    <table class="w-full border-collapse bg-white rounded-lg">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <td class="text-left px-6 py-4 font-semibold text-gray-600">Product</td>
                                <td class="text-left px-6 py-4 font-semibold text-gray-600">Status</td>
                                <td class="text-left px-6 py-4 font-semibold text-gray-600">Inventory</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="w-fit">
                            <tr class="hover:bg-gray-50 space-x-4">
                                <!-- Product -->
                                <td class="py-4 px-6 flex items-center space-x-4">
                                    <img src="https://via.placeholder.com/50" alt="Product"
                                        class="h-12 w-12 object-cover rounded-md" />
                                    <span class="text-gray-800 font-medium">Planet Print Sweatshirt</span>
                                </td>
                                <!-- Status -->
                                <td class="py-4 px-6">
                                    <span
                                        class="bg-green-400 text-green-700 text-sm font-medium px-3 py-1 rounded-full">
                                        Active
                                    </span>
                                </td>
                                <!-- Inventory -->
                                <td class="py-4 px-6 text-gray-700">10 in stock</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../../layouts/admin.php';
