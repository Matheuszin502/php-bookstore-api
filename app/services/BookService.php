<?php
namespace app\services;

require_once(dirname(__FILE__, 2) . '/repositories/BookRepository.php');

use app\repositories\BookRepository;

class BookService {
    private BookRepository $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function findById(int $id): array {
        $objects = $this->bookRepository->findById($id);
        return $objects;
    }
}