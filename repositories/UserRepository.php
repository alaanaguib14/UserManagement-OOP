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
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserById($id){
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function getUserByEmail($email){
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->execute(['email' => $email]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    function createUser($name, $email, $password, $role){
        $query = "INSERT INTO users (name, email, password, role)
                 VALUES (:name, :email, :password, :role)";
        $statement = $this->db->prepare($query);
        return $statement->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $password,
            ':role'     => $role,
        ]);
    }
    function updateUser($id, $data){
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $statement = $this->db->prepare($query);
        return $statement->execute([
            ':id'       => $id,
            ':name'     => $data['name'],
            ':email'    => $data['email']
        ]);
    }
    function deleteUser($id){
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}