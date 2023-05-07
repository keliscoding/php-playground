<?php
namespace Alura\Pdo\Infraestructure\Repository;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use DateTimeImmutable;
use PDO;

class PdoStudentRepository implements StudentRepository {

    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function findAll(): array 
    {
        $statement = $this->connection->query('SELECT * FROM students;');
        return $this->hydrateStudentList($statement);
    }

    public function studentsByBirthDate(\DateTimeInterface $birthDate): array 
    {
        $statement = $this->connection->prepare('SELECT * FROM students WHERE birth_date = :birthdate;');
        $statement->bindValue(':birthdate', $birthDate);
        $statement->execute();

        return $this->hydrateStudentList($statement);
    }

    public function save(Student $student): bool 
    {

        $statement = $this->connection->prepare("INSERT INTO students (name, birth_date) VALUES 
        (:name, :birthdate);");
        $statement->bindValue(':name', $student->name());
        $statement->bindValue(':birthdate', $student->birthDate()->format('Y-m-d'));

        return $statement->execute();
    }

    public function remove(Student $student): bool 
    {
        $statement = $this->connection->prepare('DELETE FROM students WHERE id = :id;');
        $statement->bindValue(':id', $student->id(), PDO::PARAM_INT); //nesse caso tem que explicitar que é integer

        return $statement->execute();
    }

    private function hydrateStudentList(\PDOStatement $stmt): array {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

}