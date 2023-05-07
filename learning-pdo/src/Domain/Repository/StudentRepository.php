<?php
namespace Alura\Pdo\Domain\Repository;
use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function findAll(): array;
    public function findAllWithPhones(): array;
    public function studentsByBirthDate(\DateTimeInterface $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;

}