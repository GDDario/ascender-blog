<?php

namespace AscenderBlog\Infrastructure\Persistence\Pdo\Repository;


use AscenderBlog\Infrastructure\Persistence\Pdo\PostgreSqlPdoConnection;

final readonly class PdoUserRepository
{
    private PostgreSqlPdoConnection $connection;

    public function __construct() {
        $this->connection = new PostgreSqlPdoConnection();
    }

    public function create() {

    }
}