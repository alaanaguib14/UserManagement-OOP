<?php
require_once '../helpers/response.php';
// require_once '../helpers/JWT.php';

class AuthMiddleware {
    public static function handle() {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        // Check if Authorization header exists
        if (empty($authHeader)) {
            Response::send('Unauthorized: Missing Authorization header', 401);
        }

        // Check if header starts with "Bearer "
        if (!str_starts_with($authHeader, 'Bearer ')) {
            Response::send('Unauthorized: Invalid Authorization header format', 401);
        }

        // Extract token
        $token = substr($authHeader, 7);

        // Verify JWT token
        // $payload = JWT::verify($token);

        // if ($payload === null) {
        //     Response::send('Unauthorized: Invalid or expired token', 401);
        // }

        return ;
    }
}