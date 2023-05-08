<?php

namespace Zam0k\PhpMvc\Repository;

use http\Exception\BadMethodCallException;
use Zam0k\PhpMvc\Entity\User;

class UserRepository
{
    public function __construct(private \PDO $pdo)
    {}

    public function findByEmail(string $email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if($email === false) {
            throw new BadMethodCallException("Email inválido.");
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);

        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($userData['email'] === null or $userData['password'] === null) {
            return null;
        }

        $user = new User($userData['email']);
        $user->setId($userData['id']);
        $user->setPassword($userData['password']);
        return $user;
    }
}