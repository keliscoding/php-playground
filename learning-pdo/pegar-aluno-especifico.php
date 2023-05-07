<?php
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$result = $pdo->query('SELECT * FROM students WHERE id = 2');

var_dump($result->fetchColumn(1));
exit();

while($studentData = $result->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );

    echo $student->name() . PHP_EOL;
}
