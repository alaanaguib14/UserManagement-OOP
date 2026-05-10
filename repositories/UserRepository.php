<?php
require_once '../config/database.php';

class UserRepository {
    private PDO $db;
    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getConnection();
    }
    public function getAllUsers(){
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    function getUserById($id){
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    function getUserByEmail($email){
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    function createUser($name, $email, $password, $role){
        $query = "INSERT INTO users (name, email, password, role)
                 VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $password,
            ':role'     => $role,
        ]);
    }
    function updateUser($id, $data){
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id'       => $id,
            ':name'     => $data['name'],
            ':email'    => $data['email']
        ]);
    }
    function deleteUser($id){
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}