<?php
namespace app\repositories;

require_once(dirname(__FILE__, 3) . '/config/database.php');
require_once(dirname(__FILE__, 2) . '/models/Book.php');

use config\Database, app\models\Book, mysqli_result;

class BookRepository {
    private string $tableName = "books";

    public function findAll(): array {
        $objects = [];
        $result = $this->resultSetFromFindAll();
        if ($result) {
            for ($i=0; $i < $result->num_rows; $i++) { 
                array_push($objects, new Book($result->fetch_assoc()));
            }
        }
        return $objects;
    }

    public function findById(int $id): array {
        $object = [];
        $result = $this->resultSetFromFindById($id);
        if ($result) {
            array_push($object, new Book($result->fetch_assoc()));
        }
        return $object;
    }

    public function insert(Book $book): void {
        $sql = "INSERT INTO {$this->tableName} (title, author, pages, publication_date, price) "
        . "VALUES ('{$book->getTitle()}', '{$book->getAuthor()}', {$book->getPages()}, 
        '{$book->getPublicationDate()->format('Y-m-d')}', {$book->getPrice()});";

        Database::getResultFromQuery($sql);
    }

    public function update(int $id, array $properties): void {
        $sql = "UPDATE books SET ";
        foreach ($properties as $key => $value) {
            switch ($key) {
                case 'title':
                    $sql .= "title = '{$value}', ";
                    break;
                case 'author':
                    $sql .= "author = '{$value}', ";
                    break;
                case 'pages':
                    $sql .= "pages = {$value}, ";
                    break;
                case 'publication_date':
                    $sql .= "publication_date = '{$value}', ";
                    break;
                case 'price':
                    $sql .= "price = {$value}, ";
                    break;
                default:
                    break;
            }
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id = {$id};";
        Database::getResultFromQuery($sql);
    }

    public function delete(int $id): void {
        $sql = "DELETE FROM {$this->tableName} "
        . "WHERE id = {$id};";
        Database::getResultFromQuery($sql);
    }

    public function resultSetFromFindAll(): bool|mysqli_result|null {
        $sql = "SELECT * FROM " . $this->tableName . ";";
        $result = Database::getResultFromQuery($sql);
        if ($result->num_rows == 0) {
            return null;
        } else {
            return $result;
        }
    }

    public function resultSetFromFindById(int $id): bool|mysqli_result|null {
        $sql = "SELECT * FROM " 
        . $this->tableName
        . " WHERE id = {$id};";
        $result = Database::getResultFromQuery($sql);
        if ($result->num_rows == 0) {
            return null;
        } else {
            return $result;
        }
    }

    /*private function sqlFilters(array $filters): string {
        $sql = '';
        if (count($filters) > 0) {
            $size = count($filters);
            $columns = array_keys($filters);
            $values = array_values($filters);
            for ($i = 0; $i < $size; $i++) {
                if ($i == 0) {
                    $sql .= " WHERE {$columns[$i]} = " . $this->formatedValue($values[$i]);
                } else {
                    $sql .= " AND {$columns[$i]} = " . $this->formatedValue($values[$i]);
                }
            }
        }
        return $sql;
    }

    private function formatedValue($value): mixed {
        if (gettype($value) == "string") {
            return "'{$value}'";
        } else {
            return $value;
        }
    }*/
}