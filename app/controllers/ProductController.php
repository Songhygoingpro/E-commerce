<?php

require_once '../config/database.php';
require_once '../models/ProductModel.php';

class Post {
    private $ProductModel;

    public function __construct() {
        $this->ProductModel = new ProductModel();
    }

    public function index($amount = null) {
        $products = $this->ProductModel->getAllProducts($amount);
        include 'views/products/index.php'; // Load the view for product listing
    }
}