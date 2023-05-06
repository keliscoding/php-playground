<?php

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$statement = $pdo->prepare('DELETE FROM students WHERE id = :id');
$statement->bindValue(':id', 1, PDO::PARAM_INT); //nesse caso tem que explicitar que é integer

if($statement->execute()) {
    echo 'Aluno foi de comes';
}