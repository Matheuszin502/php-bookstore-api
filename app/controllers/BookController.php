<?php
namespace app\controllers;

require_once(dirname(__FILE__, 2) . '/services/BookService.php');

use app\services\BookService;

class BookController {
    private BookService $bookService;

    public function __construct() {
        $this->bookService = new BookService();
    }

    public function findById(int $id): void {
        $book = $this->bookService->findById($id);

        if (count($book) === 0) {
            $this->jsonResponse(["Error => Book not found"], 404);
        } else {
            $this->jsonResponse($book, 200);
        }
    }

    public function jsonResponse(array $data, int $statusCode): void {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}