<?php
/**
 * Database connection class using PDO and OOP
 */
class Database {
    private $host = "localhost";
    private $db_name = "session7";
    private $username = "root";
    private $password = "";
    private $connection;

    public function getConnection() {
        $this->connection = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name}";

            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
        return $this->connection;
    }
}
// test
$db = new Database();
$conn = $db->getConnection();
