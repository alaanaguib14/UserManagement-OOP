<?php
require_once '../helpers/response.php';
require_once '../helpers/JWT.php';

class AuthMiddleware {
    public static function handle() {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';
        $token = trim(str_replace('Bearer', '', $authHeader));
        if(!$token){
            Response::send('Unauthorized, no token provided', 401);
        }
        $decoded = JWTHelper::decodeJWT($token);

        return $decoded->data;
    }
}