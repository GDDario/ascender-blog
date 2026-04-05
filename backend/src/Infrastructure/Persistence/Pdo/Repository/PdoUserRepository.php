<?php

namespace AscenderBlog\Infrastructure\Persistence\Pdo\Repository;


use AscenderBlog\Domain\Entity\User;
use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Domain\ValueObject\Uuid;
use AscenderBlog\Infrastructure\Persistence\Pdo\PostgreSqlPdoConnection;
use DateTime;
use PDO;

final readonly class PdoUserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = PostgreSqlPdoConnection::getInstance();
    }

    /**
     * @throws InvalidValueObjectException
     */
    public function save(User $user): User
    {
        $this->pdo->beginTransaction();

        $statement = $this->pdo->prepare("
            INSERT INTO users (id, username, name, email, password)
            VALUES (:id, :username, :name, :email, :password)
        ");

        $statement->execute([
            ':id' => $user->id->toString(),
            ':name' => $user->name->toString(),
            ':username' => $user->username->toString(),
            ':email' => $user->email->toString(),
            ':password' => $user->password
        ]);

        $this->pdo->commit();

        $queryStatement = $this->pdo->prepare("
            SELECT * FROM users WHERE id = :id
        ");
        $queryStatement->execute([':id' => $user->id->toString()]);
        $result = $queryStatement->fetch(PDO::FETCH_ASSOC);

//        var_dump($result['created_at']);
//        exit;

        return new User(
            id: new Uuid($result['id']),
            username: new Username($result['username']),
            name: new Name($result['name']),
            email: new Email($result['email']),
            createdAt: new DateTime($result['created_at'])
        );
    }
}