<?php

namespace App\Models;

use Config\Database;  // Corrected the namespace to match where Database class is located
use Exception;

class ProductModel
{
    private $conn;

    public function __construct()
    {
        // Initialize the database connection
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * Fetch all products with optional limit.
     *
     * @param int|null $amount Optional limit for the number of products.
     * @return array An array of products or an empty array if none are found.
     */
    public function getAllProducts($amount = null)
    {
        try {
            $query = "SELECT * FROM products ORDER BY created_at DESC";

            // Add LIMIT clause if $amount is specified
            if ($amount !== null) {
                $query .= " LIMIT ?";
            }

            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            // Bind parameter if $amount is provided
            if ($amount !== null) {
                $stmt->bind_param("i", $amount);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            // Return fetched rows if available, else return an empty array
            return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } catch (Exception $e) {
            // Provide exception message for debugging purposes
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    /**
     * Create a new product record.
     *
     * @param array $productData Associative array with product details.
     * @return bool True if the product is created successfully, otherwise false.
     */
    public function create($productData)
    {
        try {
            // Ensure product data is valid
            if (empty($productData['productTitle']) || empty($productData['productQuantity']) || empty($productData['productPrice'])) {
                throw new Exception("Missing required product data.");
            }

            $sql = "INSERT INTO products (product_title, stock_quantity, product_price, product_image) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param(
                "siss",  // s for string, i for integer
                $productData['productTitle'],
                $productData['productQuantity'],
                $productData['productPrice'],
                $productData['productImage']
            );

            return $stmt->execute();
        } catch (Exception $e) {
            // Log or display the exception for debugging purposes
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Fetch a product by its title.
     *
     * @param string|null $title The title of the product to fetch.
     * @return array|bool The product details or false on failure.
     */
    public function getProductByTitle($title = null)
    {
        try {
            // Validate title input
            if (empty($title)) {
                throw new Exception("Product title is required.");
            }

            $sql = "SELECT * FROM products WHERE product_title = ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param("s", $title);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->num_rows > 0 ? $result->fetch_assoc() : null;
        } catch (Exception $e) {
            // Provide exception message for debugging purposes
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * update a product record.
     *
     * @param array $productData Associative array with product details.
     * @return bool True if the product is created successfully, otherwise false.
     */
    public function update($productData)
    {
        try {
            // Ensure product data is valid
            if (empty($productData['productTitle']) || empty($productData['productQuantity']) || empty($productData['productPrice'])) {
                throw new Exception("Missing required product data.");
            }

            $sql = "UPDATE products SET product_title = ?, stock_quantity = ?, product_price = ?, product_image = ? WHERE product_id = ?;";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param(
                "sissi",  // s for string, i for integer
                $productData['productTitle'],
                $productData['productQuantity'],
                $productData['productPrice'],
                $productData['productImage'],
                $productData['productId']
            );

            return $stmt->execute();
        } catch (Exception $e) {
            // Log or display the exception for debugging purposes
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Delete a product by its id.
     *
     * @param number The id of the product to delete.
     */
    public function delete($id)
    {
        try {
            // Validate title input
            if (empty($id)) {
                throw new Exception("Product id is required.");
            }

            $sql = "DELETE FROM products WHERE product_id = ?;";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (Exception $e) {
            // Provide exception message for debugging purposes
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

}
