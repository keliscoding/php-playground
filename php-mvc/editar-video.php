<?php

session_start();

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, 'titulo');

if($url === false || $titulo === false || $id === false) {
    $_SESSION['status'] = 'Something went wrong';
    header('Location: /index.php');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $titulo);
$stmt->bindValue(':url', $url);

if($stmt->execute() === false) {
    $_SESSION['status'] = 'Something went wrong';
} else {
    $_SESSION['status'] = 'Video Removed Successfully';
}

header('Location: /index.php');