<?php
require_once  '../repositories/UserRepository.php';
require_once  '../Middlewares/AuthMiddleware.php';
require_once  '../Middlewares/AdminMiddleware.php';
require_once  '../Helpers/Response.php';
class UserController {
    private UserRepository $repo;
    public function __construct() {
        $this->repo = new UserRepository();
    }

    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate input
        if (empty($data['email']) || empty($data['password'])) {
            Response::send('Email and password are required', 400);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Response::send('Invalid email format', 400);
        }

        $user = $this->repo->getUserByEmail($data['email']);

        if (!$user) {
            Response::send('Invalid credentials', 401);
        }

        // Verify password
        if (!password_verify($data['password'], $user['password'])) {
            Response::send('Invalid credentials', 401);
        }

        // Generate JWT token
        $payload = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'role' => $user['role']
        ];

        // $token = JWT::generate($payload);

        Response::send('Login successful', 200, [
            //'token' => $token,
            'user' => [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'role' => $user['role']
            ]
        ]);
    }
    public function index() {
        $payload = AuthMiddleware::handle();
        $users   = $this->repo->getAllUsers();
        Response::send("users retrieved successfully", 200, $users);
    }
    public function show($id) {
        AuthMiddleware::handle();
        $user = $this->repo->getUserById($id);
        if (!$user){
            Response::send('User not found', 404, null);
        }
        Response::send("User retrieved successfully", 200, $user);
    }
    public function store(){
        AuthMiddleware::handle();
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            Response::send('Name, email, and password are required', 400);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Response::send('Invalid email format', 400);
        }
        if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $data['password'])) {
            Response::send('Password must be at least 6 characters long and contain both letters and numbers', 400);
        }
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->repo->createUser($data['name'], $data['email'], $hashedPassword, $data['role'] ?? 'Viewer');
        Response::send("User created successfully", 201);
    }
    public function update($id) {
        $payload = AuthMiddleware::handle();
        AdminMiddleware::handle($payload);
        $data= json_decode(file_get_contents('php://input'), true);
        if (empty($data['name']) || empty($data['email'])) {
            Response::send('Name and email are required', 400);
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Response::send('Invalid email format', 400);
        }
        $this->repo->updateUser($id, $data);
        Response::send("User updated successfully", 200, null);
    }
    public function destroy($id){
        $payload = AuthMiddleware::handle();
        AdminMiddleware::handle($payload);
        $this->repo->deleteUser($id);
        Response::send("User deleted successfully", 204, null);
    }
}