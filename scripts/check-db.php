<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../includes/database.php';

try {
    $config = cognita_db_config();
    $database = cognita_db();
    $database->query('SELECT 1')->fetchColumn();

    fwrite(STDOUT, sprintf(
        "MySQL PDO connection: OK (%s:%s/%s)\n",
        $config['host'],
        $config['port'],
        $config['name']
    ));

    $tableCheck = $database->prepare(
        'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table'
    );
    $tableCheck->execute(['table' => 'users']);
    if ((int) $tableCheck->fetchColumn() === 0) {
        fwrite(STDOUT, "users table: not present\n");
        exit(0);
    }

    $userCheck = $database->prepare('SELECT role, is_active FROM users WHERE email = :email LIMIT 1');
    $userCheck->execute(['email' => 'nhixinh12102005@gmail.com']);
    $user = $userCheck->fetch();
    if ($user === false) {
        fwrite(STDOUT, "Target admin: not present\n");
        exit(0);
    }

    fwrite(STDOUT, sprintf(
        "Target admin: present (role=%s, active=%s)\n",
        $user['role'],
        (bool) $user['is_active'] ? 'yes' : 'no'
    ));
} catch (Throwable $exception) {
    fwrite(STDERR, 'MySQL PDO connection failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}