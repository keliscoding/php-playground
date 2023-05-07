<?php
namespace Alura\Pdo\Infraestructure\Repository;
use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use DateTimeImmutable;
use PDO;
use RuntimeException;

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

    public function findAllWithPhones(): array 
    {
        $sqlQuery = 'SELECT students.id, 
                            students.name, 
                            students.birth_date,
                            phones.id AS phone_id,
                            phones.area_code,
                            phones.number
                    FROM students
                    JOIN phones ON students.id = phones.student_id;';
        $stmt = $this->connection->query($sqlQuery);
        $result = $stmt->fetchAll();
        $studentList = [];

        foreach ($result as $row) {
            if(!array_key_exists($row['id'], $studentList)){
                $studentList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new DateTimeImmutable($row['birth_date'])
                );
            }
            $phone = new Phone(
                $row['phone_id'],
                $row['area_code'],
                $row['number']
            );
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
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

        $statement = $this->connection->prepare("INSERT INTO studenta (name, birth_date) VALUES 
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
        $studentDataList = $stmt->fetchAll();
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

    // private function fillPhonesOf(Student $student): void
    // {
    //     $sqlQuery = 'SELECT id, area_code, number FROM phones WHERE student_id = ?';
    //     $stmt = $this->connection->prepare($sqlQuery);
    //     $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
    //     $stmt->execute();

    //     $phoneDataList = $stmt->fetchAll();
    //     foreach ($phoneDataList as $phoneData) {
    //         $phone = new Phone(
    //             $phoneData['id'],
    //             $phoneData['area_code'],
    //             $phoneData['number']
    //         );

    //         $student->addPhone($phone);
    //     }
    // }

}