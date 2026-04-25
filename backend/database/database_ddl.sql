SELECT 'CREATE DATABASE "ascender-blog"'
    WHERE NOT EXISTS (
    SELECT FROM pg_database WHERE datname = 'ascender-blog'
)\gexec;

CREATE TABLE IF NOT EXISTS users(
    id uuid primary key default UUIDV7(),
    username VARCHAR(32) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR NOT NULL,
    created_at TIMESTAMP DEFAULT NOW()
);
