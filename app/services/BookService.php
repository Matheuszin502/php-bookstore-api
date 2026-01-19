<?php
namespace app\services;

require_once(dirname(__FILE__, 2) . '/repositories/BookRepository.php');

use app\repositories\BookRepository, app\models\Book;

class BookService {
    private BookRepository $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function findAll(): array {
        $objects = $this->bookRepository->findAll();
        return $objects;
    }

    public function findById(int $id): array {
        $object = $this->bookRepository->findById($id);
        return $object;
    }

    public function insert(Book $book): void {
        $this->bookRepository->insert($book);
    }

    public function update(int $id, array $properties): void {
        $this->bookRepository->update($id, $properties);
    }

    public function delete(int $id): void {
        $this->bookRepository->delete($id);
    }
}