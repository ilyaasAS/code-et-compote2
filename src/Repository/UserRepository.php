<?php

namespace App\Repository;

use App\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * @return array|false
     */
    public function findAll(): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * from user');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * from user WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $pswd
     *
     * @return void
     */
    public function addUser(string $username, string $email, string $pswd): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO user (username, email, password) VALUES (:username, :email, :pswd)');

        $stmt->execute([':username' => $username, ':email' => $email, ':pswd' => $pswd]);
    }

    /**
     * @param string $username
     *
     * @return array|bool
     */
    public function findUserByUsername(string $username): array | bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username=:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param string $email
     *
     * @return array|bool
     */
    public function findUserByEmail(string $email): array | bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email=:email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateUserById(int $id, string $username, string $email, string $status): void
    {
        $stmt = $this->pdo->prepare('UPDATE user SET username=:username, email=:email, status=:status WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
}
