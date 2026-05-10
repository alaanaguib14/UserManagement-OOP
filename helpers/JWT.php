<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper{
    private static $secret_key = 'b4348y87hrfu83bf8cu83047hjkcbniducpr';
    private static $algorithm = 'HS256';

    public static function encodeJWT ($data){
        $issued_at = time();
        $expires_at = $issued_at + 1800; // nos sa3a
        $payload = [
            'iat' => $issued_at,
            'exp' => $expires_at,
            'data' => [
                'user_id' => $data['id'],
                'role' => $data['role']
            ]
        ];
        return JWT::encode($payload, self::$secret_key, self::$algorithm);
    }

    public static function decodeJWT ($token){
        try{
            return $decoded = JWT::decode($token,new Key(self::$secret_key, self::$algorithm));
        }catch(Exception $e){
            return Response::send('Invalid token', 401);
        }
    }
}