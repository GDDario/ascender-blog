<?php

namespace AscenderBlog\Infrastructure\Persistence\Pdo\Repository;

use AscenderBlog\Domain\Entity\User;
use AscenderBlog\Domain\Exception\DuplicatedValueException;
use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Domain\ValueObject\Uuid;
use AscenderBlog\Infrastructure\Persistence\Pdo\ErrorCodeMapper;
use AscenderBlog\Infrastructure\Persistence\Pdo\PostgreSqlPdoConnection;
use DateTime;
use PDO;
use PDOException;

final readonly class PdoUserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = PostgreSqlPdoConnection::getInstance();
    }

    /**
     * @throws InvalidValueObjectException
     * @throws DuplicatedValueException
     */
    public function save(User $user): User
    {
        $this->pdo->beginTransaction();

        $statement = $this->pdo->prepare("
            INSERT INTO users (id, username, name, email, password)
            VALUES (:id, :username, :name, :email, :password)
        ");

        try {
            $statement->execute([
                ':id' => $user->id->toString(),
                ':name' => $user->name->toString(),
                ':username' => $user->username->toString(),
                ':email' => $user->email->toString(),
                ':password' => $user->password
            ]);
        } catch (PDOException $e) {
            if (ErrorCodeMapper::isUniqueKeyViolation($e->getCode())) {
                if ($this->isUsernameError($e->getMessage())) {
                    throw new DuplicatedValueException("An username {$user->username->toString()} already has been registered.");
                } elseif ($this->isEmailError($e->getMessage())) {
                    throw new DuplicatedValueException("An email {$user->email->toString()} already has been registered.");
                }
            }
        }

        $this->pdo->commit();

        $queryStatement = $this->pdo->prepare("
            SELECT * FROM users WHERE id = :id
        ");
        $queryStatement->execute([':id' => $user->id->toString()]);
        $result = $queryStatement->fetch(PDO::FETCH_ASSOC);

        return new User(
            id: new Uuid($result['id']),
            username: new Username($result['username']),
            name: new Name($result['name']),
            email: new Email($result['email']),
            createdAt: new DateTime($result['created_at'])
        );
    }

    private function isUsernameError(string $message): bool
    {
        return str_contains($message, 'username');
    }

    private function isEmailError(string $message): bool
    {
        return str_contains($message, 'email');
    }
}
