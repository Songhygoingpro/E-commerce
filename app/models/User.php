<?php

namespace App\Models;

use Config\Database;
use Exception;

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($userData) {
        try {
            $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . $this->conn->error);
            }

            // Hash the password before storing it
            $hashedPassword = password_hash($userData['password'], PASSWORD_BCRYPT);
            
            $stmt->bind_param("sss", $userData['username'], $userData['email'], $hashedPassword);

            if ($stmt->execute()) {
                return true; // User created successfully
            } else {
                return false; // Error creating user
            }
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage();
            return false; // Error creating user
        }
    }

    public function findByEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE user_email = ?";
            $stmt = $this->conn->prepare($sql);
            
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage();
            return false; // Error finding user
        }
    }

    
}

