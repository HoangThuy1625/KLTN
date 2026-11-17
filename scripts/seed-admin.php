<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../includes/database.php';

const ADMIN_NAME = 'Đinh Thị Thùy Trâm';
const ADMIN_EMAIL = 'nhixinh12102005@gmail.com';

function ensureUsersTable(PDO $database): void
{
    $tableCheck = $database->prepare(
        'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table'
    );
    $tableCheck->execute(['table' => 'users']);

    if ((int) $tableCheck->fetchColumn() === 0) {
        $database->exec("CREATE TABLE users (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(150) NOT NULL,
            email VARCHAR(190) NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            role ENUM('student', 'admin') NOT NULL DEFAULT 'student',
            is_active TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY uq_users_email (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        fwrite(STDOUT, "Created missing users table.\n");
        return;
    }

    $columns = $database->query('SHOW COLUMNS FROM users')->fetchAll();
    $columnTypes = [];
    foreach ($columns as $column) {
        $columnTypes[$column['Field']] = $column['Type'];
    }

    $required = ['id', 'full_name', 'email', 'password_hash', 'role', 'is_active'];
    $missing = array_values(array_diff($required, array_keys($columnTypes)));
    if ($missing !== []) {
        throw new RuntimeException(
            'Existing users table is not compatible. Missing columns: ' . implode(', ', $missing) . '. No schema changes were made.'
        );
    }

    if (str_starts_with(strtolower($columnTypes['role']), 'enum(')
        && !str_contains(strtolower($columnTypes['role']), "'admin'")) {
        throw new RuntimeException('Existing users.role enum does not allow admin. No schema changes were made.');
    }
}

function promoteExistingUser(PDO $database, array $user): void
{
    if (strtolower((string) $user['role']) === 'admin') {
        fwrite(STDOUT, "Admin account already exists; no account data was changed.\n");
        return;
    }

    $statement = $database->prepare('UPDATE users SET role = :role WHERE id = :id AND role <> :admin_role');
    $statement->execute([
        'role' => 'admin',
        'id' => $user['id'],
        'admin_role' => 'admin',
    ]);
    fwrite(STDOUT, "Account already existed. Promoted its role to admin; existing name and password were preserved.\n");
}

try {
    $config = cognita_db_config();
    if (!preg_match('/^[A-Za-z0-9_]+$/', $config['name'])) {
        throw new RuntimeException('COGNITA_DB_NAME may contain only letters, numbers, and underscores.');
    }

    $server = cognita_db(false);
    $server->exec(sprintf(
        'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
        $config['name']
    ));

    $database = cognita_db();
    ensureUsersTable($database);

    $existingStatement = $database->prepare(
        'SELECT id, role FROM users WHERE email = :email LIMIT 1'
    );
    $existingStatement->execute(['email' => ADMIN_EMAIL]);
    $existingUser = $existingStatement->fetch();
    if ($existingUser !== false) {
        promoteExistingUser($database, $existingUser);
        exit(0);
    }

    $password = getenv('COGNITA_ADMIN_PASSWORD');
    if ($password === false || $password === '') {
        throw new RuntimeException('Set COGNITA_ADMIN_PASSWORD in the current shell before seeding the new account.');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    if ($passwordHash === false) {
        throw new RuntimeException('PHP could not hash the supplied password.');
    }

    $insert = $database->prepare(
        'INSERT INTO users (full_name, email, password_hash, role, is_active) VALUES (:full_name, :email, :password_hash, :role, 1)'
    );
    $insert->execute([
        'full_name' => ADMIN_NAME,
        'email' => ADMIN_EMAIL,
        'password_hash' => $passwordHash,
        'role' => 'admin',
    ]);

    fwrite(STDOUT, "Admin account created successfully. Password stored as a password_hash() hash.\n");
} catch (Throwable $exception) {
    fwrite(STDERR, 'Admin seed failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
} finally {
    putenv('COGNITA_ADMIN_PASSWORD');
}