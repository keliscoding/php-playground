<?php

require_once __DIR__ . '/vendor/autoload.php';
use Zam0k\PhpMvc\config\Connection;

$pdo = Connection::create();

$email = $argv[1];
$password = password_hash($argv[2], PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $email);
$stmt->bindParam(2, $password);
$stmt->execute();