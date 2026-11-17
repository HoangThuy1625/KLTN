<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../includes/database.php';

$fullName = 'Sinh viên Demo';
$email = 'student.demo@cognita.local';
$password = rtrim(strtr(base64_encode(random_bytes(24)), '+/', '-_'), '=');

try {
    $database = cognita_db();
    $check = $database->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $check->execute(['email' => $email]);
    if ($check->fetchColumn() !== false) {
        fwrite(STDERR, "Demo account already exists; no account data was changed.\n");
        exit(1);
    }

    $insert = $database->prepare(
        'INSERT INTO users (full_name, email, password_hash, role, is_active) VALUES (:full_name, :email, :password_hash, :role, 1)'
    );
    $insert->execute([
        'full_name' => $fullName,
        'email' => $email,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'student',
    ]);

    fwrite(STDOUT, "Demo student created. Save this temporary password now; it is not stored in source code:\n");
    fwrite(STDOUT, "Email: {$email}\nTemporary password: {$password}\n");
} catch (Throwable $exception) {
    fwrite(STDERR, 'Demo account creation failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}