<?php
namespace Zam0k\PhpMvc\Config;
use PDO;

Class Connection {
    static function create(): PDO
    {
        $dbPath = __DIR__ . '/../../db.sqlite';
        $pdo = new PDO('sqlite:' . $dbPath);
        return $pdo;
    }
}