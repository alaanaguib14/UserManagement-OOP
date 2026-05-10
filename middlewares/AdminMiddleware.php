<?php
require_once '../helpers/response.php';

class AdminMiddleware {
    public static function handle($payload) {
        if (!isset($payload->role)) {
            Response::send('Forbidden: User role not found', 403);
        }

        if ($payload->role !== 'Admin') {
            Response::send('Forbidden: Admin access required', 403);
        }
    }
}