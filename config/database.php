<?php
// class Database {
//     private static ?Database $instance = null;
//     private PDO $connection;

//     private string $host = 'localhost';
//     private string $db   = 'user_management';
//     private string $user = 'root';
//     private string $pass = '';

//     private function __construct() {
//         $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8";
//         $this->connection = new PDO($dsn, $this->user, $this->pass, [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//         ]);
//     }

//     public static function getInstance(): Database {
//         if (self::$instance === null) {
//             self::$instance = new Database();
//         }
//         return self::$instance;
//     }

//     public function getConnection(): PDO {
//         return $this->connection;
//     }
// }


// namespace App\Config;

// use PDO;
// use PDOException;

// class Database {
//     private static ?PDO $instance = null;

//     public static function getConnection(): PDO {
//         if (self::$instance === null) {
//             try {
//                 $host = 'localhost';
//                 $db   = 'session7'; // The DB we created together
//                 $user = 'root';
//                 $pass = '';

//                 $dsn = "mysql:host=$host;dbname=$db";
                
//                 self::$instance = new PDO($dsn, $user, $pass, [
//                     PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
//                     PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
//                     PDO::ATTR_EMULATE_PREPARES=>false,
//                 ]);
//             } catch (PDOException $e) {
//                 echo "Database Connection Error: " . $e->getMessage();
//             }
//         }
//         return self::$instance;
//     }
// }

// class Database {
//     private $host_name = 'localhost';
//     private $db_name = 'session7';
//     private $user_name = 'root';
//     private $password = '';
//     private $connection;
    
//     public function connect() {
//         $this->connection = null;
//         try {
//             $this->connection = new PDO('mysql:host ='.$this->host_name.'; dbname = '.$this->db_name, $this->user_name, $this->password);
            
//             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch(PDOException $e) {
//             echo 'Connection error: '.$e->getMessage();
//         }
//         return $this->connection;
//     }
// }

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
