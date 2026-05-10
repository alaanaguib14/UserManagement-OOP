<?php
require_once '../helpers/response.php';
require_once '../controllers/UserController.php';

$controller = new UserController();
$path = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

if($path === '/login' && $method === 'POST'){
    $controller->login();
}elseif($path === '/users' && $method === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'] ?? null;
    if (!$id) Response::send('User ID is required', 400);
    $controller->show($id);
} elseif($path === '/users' && $method === 'GET'){
    $controller->index();
} elseif($path === '/users' && $method === 'POST'){
    $controller->store();
} elseif($path === '/users'&& isset($_GET['id']) && $method === 'PUT'){
    $id = $_GET['id'] ?? null;
    if (!$id) Response::send('User ID is required', 400);
    $controller->update($id);
} elseif($path === '/users'&& isset($_GET['id']) && $method === 'DELETE'){
    $id = $_GET['id'] ?? null;
    if (!$id) Response::send('User ID is required', 400);
    $controller->destroy($id);
} else {
    Response::send('Route not found', 404);
}
