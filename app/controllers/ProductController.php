<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController
{
    private $productModel;

    public function __construct()
    {
        // Initialize the ProductModel
        $this->productModel = new ProductModel();
    }


    /**
     * Handle the index action.
     *
     * @param int|null $amount Number of products to fetch (optional).
     * @return array
     */
    public function index($amount = null)
    {
        // Fetch all products from the model
        $products = $this->productModel->getAllProducts($amount);

        // Return the products or an empty array if no products exist
        return $products ?? [];
    }




    /**
     * Handle the store action to create a new product.
     */
    public function store()
    {
        // Check if form data exists
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'store') {
            // Validate and sanitize POST data
            $productData = [
                "productTitle" => $_POST["product-title"] ?? null,
                "productImage" => $_FILES["product-media"]["name"] ?? null,  // Handle file upload
                "productQuantity" => filter_var($_POST["product-quantity"] ?? null, FILTER_VALIDATE_INT),
                "productPrice" => filter_var($_POST["product-price"] ?? null, FILTER_VALIDATE_FLOAT),
            ];

            // Validate data
            if (empty($productData['productTitle'])) {
                $_SESSION['error'] = 'Product title is required.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }

            // Check if the product already exists
            if ($this->productModel->getProductByTitle($productData['productTitle'])) {
                $_SESSION['error'] = 'Product already exists.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }

            // Handle file upload for product media
            if (isset($_FILES['product-media']) && $_FILES['product-media']['error'] === 0) {
                // Specify upload directory and allowed types
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/public/assets/uploads/';
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($_FILES['product-media']['tmp_name']);
                $fileName = uniqid() . '_' . basename($_FILES['product-media']['name']);
                $filePath = $uploadDir . $fileName;

                // Validate file type
                if (in_array($fileType, $allowedTypes)) {
                    // Create the upload directory if it doesn't exist
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($_FILES['product-media']['tmp_name'], $filePath)) {
                        $productData['productImage'] = '/public/assets/uploads/' . $fileName;
                    } else {
                        $_SESSION['error'] = 'Failed to move the uploaded file.';
                        header('Location: /e-commerce/app/views/admin/products');
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Invalid file type. Please upload an image.';
                    header('Location: /e-commerce/app/views/admin/products');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'No file uploaded or an error occurred.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }


            // Attempt to create the product in the database
            if ($this->productModel->create($productData)) {
                $_SESSION['success'] = 'Product created successfully.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            } else {
                $_SESSION['error'] = 'Error creating product. Please try again.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }
        }
    }


    /**
     * Handle the edit action.
     */

    public function edit($title)
    {
        return $this->productModel->getProductByTitle($title);
    }

    /**
     * Handle the update action.
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
            // Validate and sanitize POST data
            $productData = [
                "productId" => $_POST["product-id"],
                "productTitle" => trim($_POST["product-title"]) ?? null,
                "productImage" => $_POST['product-image'] ?? null,
                "productQuantity" => filter_var($_POST["product-quantity"] ?? null, FILTER_VALIDATE_INT),
                "productPrice" => filter_var($_POST["product-price"] ?? null, FILTER_VALIDATE_FLOAT),
            ];

            // Validate product title
            if (empty($productData['productTitle'])) {
                $_SESSION['error'] = 'Product title is required.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }

            // Check if the product already exists
            $existingProduct = $this->productModel->getProductByTitle($productData['productTitle']);
            if ($existingProduct && $existingProduct['product_id'] != $productData["productId"]) {
                $_SESSION['error'] = 'A product with this title already exists.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }

            // Handle file upload for product media
            if (isset($_FILES['product-media']) && $_FILES['product-media']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/public/assets/uploads/';
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileTmpPath = $_FILES['product-media']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = uniqid() . '_' . basename($_FILES['product-media']['name']);
                $filePath = $uploadDir . $fileName;

                if (in_array($fileType, $allowedTypes)) {
                    // Create the upload directory if it doesn't exist
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($fileTmpPath, $filePath)) {
                        $productData['productImage'] = '/public/assets/uploads/' . $fileName;
                    } else {
                        $_SESSION['error'] = 'Failed to save the uploaded file.';
                        header('Location: /e-commerce/app/views/admin/products');
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Invalid file type. Please upload a valid image.';
                    header('Location: /e-commerce/app/views/admin/products');
                    exit();
                }
            }

            // Ensure required fields are provided
            if (!$productData['productQuantity'] || !$productData['productPrice']) {
                $_SESSION['error'] = 'Product quantity and price must be valid numbers.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }

            // Attempt to update the product in the database
            if ($this->productModel->update($productData)) {
                $_SESSION['success'] = 'Product updated successfully.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            } else {
                $_SESSION['error'] = 'Error updating product. Please try again.';
                header('Location: /e-commerce/app/views/admin/products');
                exit();
            }
        }
    }

    /**
     * Handle the destroy action.
     */

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'destroy') {
            $this->productModel->delete($id);
            header('Location: /e-commerce/app/views/admin/products');
        }
    }

}

