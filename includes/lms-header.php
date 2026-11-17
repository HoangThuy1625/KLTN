<?php
require_once __DIR__ . '/auth.php';

$active_page = $active_page ?? 'lo-trinh';
$is_admin = $is_admin ?? false;
$allowed_roles = $allowed_roles ?? [$is_admin ? 'admin' : 'student'];
cognita_require_roles($allowed_roles);
$current_user = cognita_is_mock_auth()
  ? ['full_name' => 'Sinh viên Demo', 'email' => 'student.demo@cognita.local', 'role' => 'student']
  : cognita_current_user();
$is_admin = $current_user['role'] === 'admin';
$home_href = cognita_home_for_role($current_user['role']);
$lms_pages = $is_admin ? [
  'accounts' => ['href' => '#users', 'label' => 'Người dùng'],
  'quiz-bank' => ['href' => '#quiz-bank', 'label' => 'Ngân hàng câu hỏi'],
  'ai-audit' => ['href' => '#ai-audit', 'label' => 'AI Audit'],
] : [
  'ket-qua' => ['href' => 'ket-qua.php', 'label' => 'Live Analytics'],
  'chi-tiet-tram' => ['href' => 'chi-tiet-tram.php', 'label' => 'Learning Path'],
];
$header_name = $current_user['full_name'];
$name_parts = preg_split('/\s+/u', trim($header_name), -1, PREG_SPLIT_NO_EMPTY);
$first_initial = preg_match('/^./u', $name_parts[0] ?? '', $first_match) ? $first_match[0] : 'U';
$last_initial = preg_match('/^./u', $name_parts[count($name_parts) - 1] ?? '', $last_match) ? $last_match[0] : '';
$header_initials = function_exists('mb_strtoupper')
  ? mb_strtoupper($first_initial . $last_initial, 'UTF-8')
  : strtoupper($first_initial . $last_initial);
$header_role = $is_admin ? 'Quản trị viên' : 'Học viên';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title ?? 'Cognita AI LMS') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/lms.css">
</head>
<body class="<?= htmlspecialchars($body_class ?? '') ?>">
<header class="topbar">
  <a class="brand-link" href="<?= $home_href ?>" aria-label="Cognita AI LMS - Trang chủ">
    <span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
    <span class="brand-copy"><strong>Cognita AI</strong><small>LMS</small></span>
  </a>
  <button class="mobile-nav-toggle" id="mobile-nav-toggle" type="button" aria-label="Mở menu điều hướng" aria-expanded="false" aria-controls="main-sidebar">
    <span class="menu-icon" aria-hidden="true"><i></i><i></i><i></i></span>
  </button>
  <nav class="topnav" aria-label="Điều hướng chính">
    <a href="<?= $home_href ?>" class="<?= $active_page === ($is_admin ? 'quan-tri' : 'lo-trinh') ? 'selected' : '' ?>"><?= $is_admin ? 'Tổng quan' : 'Dashboard' ?></a>
    <?php foreach ($lms_pages as $key => $link): ?>
      <a href="<?= $link['href'] ?>" class="<?= $active_page === $key ? 'selected' : '' ?>"><?= $link['label'] ?></a>
    <?php endforeach; ?>
    <?php if (!$is_admin): ?><a href="chi-tiet-tram.php#ai-mentor">AI Diagnostics</a><?php endif; ?>
  </nav>
  <div class="topbar-tools">
    <label class="search-box"><svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 4 4"></path></svg><input type="search" placeholder="Tìm kiếm khóa học..." aria-label="Tìm kiếm khóa học"></label>
    <button class="icon-button" type="button" aria-label="Thông báo"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path><path d="M10 21h4"></path></svg><i></i></button>
    <div class="account-menu">
      <button class="user-chip" id="account-menu-button" type="button" aria-expanded="false" aria-controls="account-menu" aria-haspopup="true">
        <span class="avatar"><?= $header_initials ?></span>
        <span class="user-details"><strong><?= htmlspecialchars($header_name) ?></strong><small><?= htmlspecialchars($header_role) ?></small></span>
        <span class="account-chevron" aria-hidden="true">⌄</span>
      </button>
      <div class="account-dropdown" id="account-menu" hidden>
        <div class="account-dropdown-heading">
          <span class="avatar"><?= $header_initials ?></span>
          <span><strong><?= htmlspecialchars($header_name) ?></strong><small><?= htmlspecialchars($header_role) ?> Cognita AI</small></span>
        </div>
        <div class="account-dropdown-divider"></div>
        <a class="logout-link" href="dang-xuat.php"><span aria-hidden="true">↪</span> Đăng xuất</a>
      </div>
    </div>
  </div>
</header>
<div class="sidebar-backdrop" id="sidebar-backdrop" hidden></div>
<div class="app-shell">
  <aside class="sidebar" id="main-sidebar" aria-label="Điều hướng bên">
    <a href="<?= $home_href ?>" class="side-brand"><span class="side-brand-icon">C</span><span><strong>Cognita Core</strong><small><?= $is_admin ? 'Admin Console' : 'Student Workspace' ?></small></span></a>
    <div class="side-label"><?= $is_admin ? 'QUẢN TRỊ HỆ THỐNG' : 'LEARNING SPACE' ?></div>
    <?php if ($is_admin): ?>
      <a class="side-link active" href="quan-tri.php"><span class="side-link-icon" aria-hidden="true">▦</span><span class="side-link-label">Tổng quan hệ thống</span></a>
      <a class="side-link" href="quan-tri.php#users"><span class="side-link-icon" aria-hidden="true">♙</span><span class="side-link-label">Quản lý người dùng</span></a>
      <a class="side-link" href="quan-tri.php#quiz-bank"><span class="side-link-icon" aria-hidden="true">▤</span><span class="side-link-label">Ngân hàng câu hỏi</span></a>
      <a class="side-link" href="quan-tri.php#ai-audit"><span class="side-link-icon" aria-hidden="true">✦</span><span class="side-link-label">Giám sát AI</span></a>
      <a class="side-link" href="tai-lieu.php"><span class="side-link-icon" aria-hidden="true">▧</span><span class="side-link-label">Tài liệu học tập</span></a>
      <a class="side-link" href="ket-qua.php"><span class="side-link-icon" aria-hidden="true">⌁</span><span class="side-link-label">Thống kê &amp; báo cáo</span></a>
      <a class="side-link" href="dang-xuat.php"><span class="side-link-icon" aria-hidden="true">↪</span><span class="side-link-label">Đăng xuất</span></a>
      <div class="side-help"><span class="help-icon">●</span><strong>Hệ thống ổn định</strong><p>AI Core đang hoạt động bình thường.</p><a href="#ai-audit">Mở AI Audit <span>→</span></a></div>
    <?php else: ?>
      <a class="side-link <?= $active_page === 'lo-trinh' ? 'active' : '' ?>" href="lo-trinh.php"><span class="side-link-icon" aria-hidden="true">◫</span><span class="side-link-label">Learning Path</span></a>
      <a class="side-link <?= $active_page === 'chi-tiet-tram' ? 'active' : '' ?>" href="chi-tiet-tram.php"><span class="side-link-icon" aria-hidden="true">◎</span><span class="side-link-label">AI Assistant</span><b class="online-dot">Live</b></a>
      <a class="side-link <?= $active_page === 'tram-2-4' ? 'active' : '' ?>" href="tram-2-4.php"><span class="side-link-icon" aria-hidden="true">▤</span><span class="side-link-label">Courses &amp; Modules</span></a>
      <a class="side-link <?= $active_page === 'tai-lieu' ? 'active' : '' ?>" href="tai-lieu.php"><span class="side-link-icon" aria-hidden="true">▧</span><span class="side-link-label">Tài liệu học tập</span></a>
      <a class="side-link <?= $active_page === 'ket-qua' ? 'active' : '' ?>" href="ket-qua.php"><span class="side-link-icon" aria-hidden="true">⌁</span><span class="side-link-label">Analytics &amp; Mastery</span></a>
      <a class="side-link" href="ket-qua.php#milestones"><span class="side-link-icon" aria-hidden="true">⚑</span><span class="side-link-label">Goals &amp; Milestones</span></a>
      <div class="side-help"><span class="help-icon">✧</span><strong>Cần trợ giúp?</strong><p>Gia sư AI luôn sẵn sàng đồng hành cùng bạn.</p><a href="chi-tiet-tram.php#ai-mentor">Ask AI Mentor <span>→</span></a></div>
    <?php endif; ?>
    <div class="sidebar-bottom">
      <?php if ($is_admin): ?><span>⌕ &nbsp; User &amp; Access Control</span><span>⚙ &nbsp; System Telemetry</span><span>♢ &nbsp; Compatibility Alerts</span><?php else: ?><span>⌕ &nbsp; User &amp; AIC Hub</span><span>⚙ &nbsp; System Telemetry</span><span>♢ &nbsp; Compatibility Alerts</span><?php endif; ?>
    </div>
  </aside>
  <main class="page-content">
