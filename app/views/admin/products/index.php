<?php

session_start();
require_once '../../../../vendor/autoload.php';

use App\Controllers\ProductController;

// Instantiate the controller and get the products
$controller = new ProductController();
$products = $controller->index(); // Assuming the `index` method returns product data

// Start capturing the output
ob_start();
?>

<section class="products py-10 px-16 flex flex-col gap-6 bg-[#E0E0E0] h-full w-full">
    <h1 class="text-2xl lg:text-3xl font-bold">Product</h1>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-md mb-4">
            <?= $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error bg-red-100 text-red-700 p-4 rounded-md mb-4">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="products__inner w-full space-y-4 h-full flex flex-col">
        <div class="flex justify-between">
            <form method="GET" action="" class="flex gap-4 items-center">
                <input class="border border-gray-600 rounded-md indent-4 h-full placeholder:text-sm"
                    placeholder="Search for product" type="text" name="search" id="search"
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit" class="bg-black text-white text-center px-6 py-2 rounded-md">
                    Search
                </button>
            </form>
            <a href="create.php" class="bg-black text-white text-center px-6 py-2 rounded-md">
                Add new product
            </a>
        </div>
        <div class="products-board border-2 border-black flex flex-col rounded-md w-full h-full">
            <div class="product-sort bg-white w-full p-4 border-b border-black flex gap-6">
                <button class="sort-btn">All</button>
                <button class="sort-btn">Active</button>
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
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr class="hover:bg-gray-50 group cursor-pointer" data-href="edit.php?product_title=<?= $product['product_title'] ?>">
                                        <!-- Product -->
                                        <td class="py-4 px-6 flex items-center space-x-4">
                                            <img src="<?= $product['product_image'] ? '/e-commerce/' . $product['product_image'] : 'https://via.placeholder.com/100x100' ?>"
                                                alt="Product" class="h-12 w-12 object-cover rounded-md" />
                                            <span class="text-gray-800 font-medium group-hover:underline">
                                                <?= htmlspecialchars($product['product_title']) ?>
                                            </span>
                                        </td>
                                        <!-- Status -->
                                        <td class="py-4 px-6">
                                            <span
                                                class="bg-green-400 text-green-700 text-sm font-medium px-3 py-1 rounded-full">
                                                Active
                                            </span>
                                        </td>
                                        <!-- Inventory -->
                                        <td class="py-4 px-6 text-gray-700">
                                            <?= htmlspecialchars($product['stock_quantity']) ?>
                                        </td>
                                        <!-- Edit/Delete Actions -->
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    No products found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    // Example of sorting functionality, you can adjust this with actual filtering logic
    document.querySelectorAll('.sort-btn').forEach(button => {
        button.addEventListener('click', () => {
            // Example: You can filter by the status here
            alert('Filter by ' + button.innerText);
        });
    });
</script>

<?php
// Capture the page content
$content = ob_get_clean();

// Include the main layout
include '../../layouts/admin.php';
?>