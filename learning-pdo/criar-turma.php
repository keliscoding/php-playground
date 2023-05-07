<?php
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infraestructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

//begin transaction
$connection->beginTransaction();

try {

    $studentRepository->save(new Student(null, "Coral Coraline", new DateTimeImmutable('2012-07-03')));
    $studentRepository->save(new Student(null, "Cassiel Wolfe Hughes", new DateTimeImmutable('2012-10-25')));
    $studentRepository->save(new Student(null, "Lil Llus", new DateTimeImmutable('1985-12-01')));

    $connection->commit(); 
    
} catch(PDOException $e) {
    echo $e->getMessage();
    $connection->rollBack();
}//finaliza

//se precisar cancelar a transacao use rollback