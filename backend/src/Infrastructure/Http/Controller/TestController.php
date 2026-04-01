<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Infrastructure\Database\PostgreSQL\Connection;
use AscenderBlog\Infrastructure\Http\Controller;
use PDO;

final readonly class TestController extends Controller
{
    public function index(): void
    {
        $pdo = Connection::getInstance();
        $statement = $pdo->prepare('SELECT * from users');
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($users as $user) {
            echo $user->name . '<br>';
        }
    }

    public function notFound(): void
    {
        var_dump('NOT FOUND METHOD');
    }
}