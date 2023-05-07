<?php
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Azai Wolfe', new DateTimeImmutable('1993-09-15'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES 
    (:name, :birthdate)";

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birthdate', $student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluído";
}