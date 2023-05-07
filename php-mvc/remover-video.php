<?php

session_start();

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$id = $_GET['id'];
$sql = 'DELETE FROM videos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

if($stmt->execute() === false) {
    $_SESSION['status'] = 'Something went wrong';
} else {
    $_SESSION['status'] = 'Video Removed Successfully';
}

header('Location: /');