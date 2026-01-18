<?php
namespace app\repositories;

require_once(dirname(__FILE__, 3) . '/config/database.php');
require_once(dirname(__FILE__, 2) . '/models/Book.php');

use config\Database, app\models\Book, mysqli_result;

class BookRepository {
    private string $tableName = "books";

    public function findById(int $id): array {
        $objects = [];
        $result = $this->resultSetFromFindById($id, "*");
        if ($result) {
            array_push($objects, new Book($result->fetch_assoc()));
        }
        return $objects;
    }

    public function resultSetFromFindById(int $id, string $columns): bool|mysqli_result|null {
        $sql = "SELECT {$columns} FROM " 
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