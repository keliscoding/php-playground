<?php
use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$result = $pdo->query('SELECT * FROM students WHERE id = 1');

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
