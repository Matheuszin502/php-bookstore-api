<?php
namespace config;

use mysqli, mysqli_result;

class Database {

    public static function getConnection(): mysqli {
        $envPath = realpath(dirname(__FILE__, 2) . "/.env.ini");
        $env = parse_ini_file($envPath);
        $conn = new mysqli($env["host"], $env["username"], 
        $env["password"], $env["database"]);

        if ($conn->connect_error) {
            die("Error: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function getResultFromQuery(string $sql): bool|mysqli_result {
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}