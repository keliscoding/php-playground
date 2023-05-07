<?php

session_start();

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$id = $_GET['id'];

if($id === false || $id === null) {
    $_SESSION['status'] = 'Something went wrong';
    header('Location: /');
    exit();
}

$sql = 'DELETE FROM videos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

if($stmt->execute() === false) {
    $_SESSION['status'] = 'Something went wrong';
} else {
    $_SESSION['status'] = 'Video Removed Successfully';
}

header('Location: /');