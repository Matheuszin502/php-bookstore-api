<?php
require_once(dirname(__FILE__, 2) . "/config/config.php");
require_once(dirname(__FILE__, 2) . "/app/controllers/BookController.php");

use app\controllers\BookController;

$basePath = '/php-bookstore-api/public/index.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace($basePath, '', $uri);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match
('#^/api/books$#', $uri, $matches)) {
    $controller = new BookController();
    $controller->findAll();
}
elseif ($method === 'GET' && preg_match
('#^/api/books/(\d+)$#', $uri, $matches)) {
    $controller = new BookController();
    $controller->findById((int) $matches[1]);
}
elseif ($method === 'POST' && preg_match
('#^/api/books$#', $uri, $matches)) {
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['Error' => 'Invalid request body']);
    }

    $controller = new BookController();
    $controller->insert($data);
}
elseif ($method === 'PUT' && preg_match
('#^/api/books/(\d+)$#', $uri, $matches)) {
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['Error' => 'Invalid request body']);
    }

    $controller = new BookController();
    $controller->update((int) $matches[1], $data);
}
elseif ($method === 'DELETE' && preg_match
('#^/api/books/(\d+)$#', $uri, $matches)) {
    $controller = new BookController();
    $controller->delete((int) $matches[1]);
} else {
    http_response_code(404);
    echo json_encode(['Error' => 'Route not found']);
}