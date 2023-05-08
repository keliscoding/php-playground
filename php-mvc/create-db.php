<?php
require_once __DIR__ . '/vendor/autoload.php';
use Zam0k\PhpMvc\config\Connection;

$pdo = Connection::create();
//$pdo->exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT)');

$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT, password TEXT);');
