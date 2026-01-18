<?php
require_once(dirname(__FILE__, 2) . "/app/controllers/BookController.php");

use app\controllers\BookController;

$basePath = '/php-bookstore-api/public/index.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace($basePath, '', $uri);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match
('#^/api/books/(\d+)$#', $uri, $matches)) {
    $controller = new BookController();
    $controller->findById((int) $matches[1]);
} else {
    http_response_code(404);
    echo json_encode(['Error' => 'Route not found']);
}