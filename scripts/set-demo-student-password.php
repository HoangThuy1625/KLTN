<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../includes/database.php';

$email = 'student.demo@cognita.local';
$password = getenv('COGNITA_DEMO_STUDENT_PASSWORD');
if ($password === false || $password === '') {
    fwrite(STDERR, "Set COGNITA_DEMO_STUDENT_PASSWORD in the current shell.\n");
    exit(1);
}

try {
    $database = cognita_db();
    $find = $database->prepare('SELECT id, role FROM users WHERE email = :email LIMIT 1');
    $find->execute(['email' => $email]);
    $user = $find->fetch();

    if ($user === false || $user['role'] !== 'student') {
        throw new RuntimeException('The expected demo student was not found; no account was changed.');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    if ($hash === false) {
        throw new RuntimeException('PHP could not hash the supplied password.');
    }

    $update = $database->prepare(
        'UPDATE users SET password_hash = :password_hash WHERE id = :id AND email = :email AND role = :role'
    );
    $update->execute([
        'password_hash' => $hash,
        'id' => $user['id'],
        'email' => $email,
        'role' => 'student',
    ]);

    if ($update->rowCount() !== 1) {
        throw new RuntimeException('Password update was not confirmed.');
    }

    fwrite(STDOUT, "Demo student password updated with password_hash(); no other account fields were changed.\n");
} catch (Throwable $exception) {
    fwrite(STDERR, 'Demo student password update failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
} finally {
    putenv('COGNITA_DEMO_STUDENT_PASSWORD');
}