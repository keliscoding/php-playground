<?php

session_start();

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, 'titulo');

if($url === false || $titulo === false) {
    $_SESSION['status'] = 'Something went wrong';
    header('Location: /index.php');
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $titulo);

if($stmt->execute() === false) {
    $_SESSION['status'] = 'Something went wrong';
} else {
    $_SESSION['status'] = 'Video Inserted Successfully';
}

header('Location: /index.php');

