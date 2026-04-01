<?php

namespace AscenderBlog\Infrastructure\Database\PostgreSQL;

use PDO;

final  class Connection
{
    private const string DATABASE_NAME = 'ascender-blog';
    private const string DATABASE_USER = 'postgres';
    private const string DATABASE_PASSWORD = 'password';
    private const string DATABASE_HOST = 'localhost';
    private const string DATABASE_PORT = '5432';

    public static ?PDO $connection = null;

    public static function getInstance(): PDO {
        if (self::$connection === null) {
            return self::connect();
        }

        return self::$connection;
    }

    public static function connect(): PDO {
        $host = self::DATABASE_HOST;
        $port = self::DATABASE_PORT;
        $name = self::DATABASE_NAME;
        $user = self::DATABASE_USER;
        $password = self::DATABASE_PASSWORD;

        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$name", $user, $password);
        self::$connection = $pdo;

        return $pdo;
    }
}