<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

function cognita_is_mock_auth(): bool
{
    // Nếu env var đã được đặt tường minh, dùng giá trị đó.
    $envMode = getenv('COGNITA_AUTH_MODE');
    if ($envMode !== false && $envMode !== '') {
        return strtolower($envMode) === 'mock';
    }

    // Auto-detect: Tự động bật Mock Mode khi chạy PHP Built-in Development Server
    // (`php -S localhost:8000`). SERVER_SOFTWARE sẽ chứa chuỗi "Development Server".
    // Cơ chế này chỉ kích hoạt trên máy local — KHÔNG BAO GIỜ trên server thật
    // vì Nginx/Apache/FPM không set SERVER_SOFTWARE theo cách này.
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
    if (stripos($serverSoftware, 'Development Server') !== false) {
        return true;
    }

    return false;
}

function cognita_start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
        'path' => '/',
    ]);
    session_start();
}

function cognita_current_user(): ?array
{
    cognita_start_session();
    $user = $_SESSION['cognita_user'] ?? null;
    return is_array($user) ? $user : null;
}

function cognita_login_user(array $user): void
{
    cognita_start_session();
    session_regenerate_id(true);
    $_SESSION['cognita_user'] = [
        'id' => (int) $user['id'],
        'full_name' => (string) $user['full_name'],
        'email' => (string) $user['email'],
        'role' => (string) $user['role'],
    ];
}

function cognita_logout_user(): void
{
    cognita_start_session();
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires' => time() - 42000,
            'path' => $params['path'],
            'domain' => $params['domain'],
            'secure' => $params['secure'],
            'httponly' => $params['httponly'],
            'samesite' => $params['samesite'] ?? 'Lax',
        ]);
    }

    session_destroy();
}

function cognita_home_for_role(string $role): string
{
    return $role === 'admin' ? 'quan-tri.php' : 'lo-trinh.php';
}

function cognita_require_roles(array $allowedRoles): void
{
    if (cognita_is_mock_auth()) {
        if (in_array('student', $allowedRoles, true)) {
            return;
        }

        header('Location: lo-trinh.php');
        exit;
    }

    $user = cognita_current_user();
    if ($user === null) {
        header('Location: dang-nhap.php');
        exit;
    }

    if (!in_array($user['role'], $allowedRoles, true)) {
        header('Location: ' . cognita_home_for_role($user['role']));
        exit;
    }
}

function cognita_find_user_by_email(string $email): ?array
{
    $statement = cognita_db()->prepare(
        'SELECT id, full_name, email, password_hash, role, is_active FROM users WHERE email = :email LIMIT 1'
    );
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();
    return $user === false ? null : $user;
}