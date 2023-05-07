<?php
use Zam0k\PhpMvc\config\Connection;

$pdo = Connection::create();
$pdo->exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT)');
