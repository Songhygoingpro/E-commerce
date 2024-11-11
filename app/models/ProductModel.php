<?php

require_once '../config/database.php';
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllProducts($amount = null)
    {
        // Modify the query to include LIMIT if $amount is specified
        $query = "SELECT product_name, product_description, product_price, product_image
                  FROM products
                  ORDER BY created_at DESC";
    
        // Add LIMIT clause only if $amount is provided
        if ($amount !== null) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->conn->prepare($query);
        // Bind $amount if it's used in the query
        if ($amount !== null) {
            $stmt->bind_param("i", $amount);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Return an empty array if no results are found
    }
    


}
