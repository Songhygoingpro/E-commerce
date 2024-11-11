<?php
require_once __DIR__ . '/config.php';

class Database {

    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;
    private $connection;

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        return $this->connection;
    }
}
