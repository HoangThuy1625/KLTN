<?php
declare(strict_types=1);

function cognita_db_config(): array
{
    $user = getenv('COGNITA_DB_USER');
    if ($user === false || $user === '') {
        throw new RuntimeException('Set COGNITA_DB_USER before connecting to MySQL.');
    }

    $password = getenv('COGNITA_DB_PASSWORD');
    if ($password === false || $password === '') {
        $password = getenv('COGNITA_DB_PASS');
    }

    return [
        'host' => getenv('COGNITA_DB_HOST') ?: '127.0.0.1',
        'port' => getenv('COGNITA_DB_PORT') ?: '3306',
        'name' => getenv('COGNITA_DB_NAME') ?: 'cognita_lms',
        'user' => $user,
        'password' => $password === false ? '' : $password,
    ];
}

function cognita_db(bool $withDatabase = true): PDO
{
    static $connections = [];
    $config = cognita_db_config();
    $key = $withDatabase ? 'database' : 'server';
    if (isset($connections[$key])) {
        return $connections[$key];
    }

    $database = $withDatabase ? ';dbname=' . $config['name'] : '';
    $dsn = sprintf(
        'mysql:host=%s;port=%s%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $database
    );

    $connections[$key] = new PDO($dsn, $config['user'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $connections[$key];
}