<?php
namespace app\controllers;

require_once(dirname(__FILE__, 2) . '/services/BookService.php');

use app\services\BookService, app\models\Book;

class BookController {
    private BookService $bookService;

    public function __construct() {
        $this->bookService = new BookService();
    }

    public function findAll(): void {
        $books = $this->bookService->findAll();
        $this->jsonResponse($books, 200);
    }

    public function findById(int $id): void {
        $book = $this->bookService->findById($id);

        if (count($book) === 0) {
            $this->jsonResponse(["Error => Book not found"], 404);
        } else {
            $this->jsonResponse($book, 200);
        }
    }

    public function insert(array $properties): void {
        $book = new Book($properties);
        $this->bookService->insert($book);
        http_response_code(201);
        header("Content-Type: application/json");
    }

    public function update(int $id, array $properties): void {
        $this->bookService->update($id, $properties);
        http_response_code(204);
        header("Content-Type: application/json");
    }

    public function delete(int $id): void {
        $this->bookService->delete($id);
        http_response_code(204);
        header("Content-Type: application/json");
    }

    public function jsonResponse(array $data, int $statusCode): void {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}