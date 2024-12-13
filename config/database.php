<?php
namespace Config;  // Corrected namespace for classes in the config folder

use Config\Config; // Import the Config class to use constants

class database {

    private $host;
    private $username;
    private $password;
    private $dbname;
    private $connection;

    public function __construct() {
        // Use constants from the Config class
        $this->host = Config::DB_HOST;
        $this->username = Config::DB_USER;
        $this->password = Config::DB_PASS;
        $this->dbname = Config::DB_NAME;
    }

    public function connect() {
        // Create a new MySQLi connection
        $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check for connection errors
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        return $this->connection;
    }
}
