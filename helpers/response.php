<?php
class Response {
    public static function send( $message, $statusCode, $data = null){
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'message' => $message,
            'data' => $data
        ]);
        exit();
    }   
}
