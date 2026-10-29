<?php
$active_page = $active_page ?? 'lo-trinh';
$lms_pages = [
  'lo-trinh' => ['href' => 'lo-trinh.php', 'label' => 'Curriculum'],
  'ket-qua' => ['href' => 'ket-qua.php', 'label' => 'Live Analytics'],
  'chi-tiet-tram' => ['href' => 'chi-tiet-tram.php', 'label' => 'Learning Path'],
];
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
  <a class="brand-link" href="lo-trinh.php" aria-label="Cognita AI LMS - Trang chủ">
    <span class="brand-mark">✦</span>
    <span class="brand-copy"><strong>Cognita AI</strong><small>LMS</small></span>
  </a>
  <nav class="topnav" aria-label="Điều hướng chính">
    <a href="lo-trinh.php" class="<?= $active_page === 'lo-trinh' ? 'selected' : '' ?>">Dashboard</a>
    <?php foreach ($lms_pages as $key => $link): ?>
      <a href="<?= $link['href'] ?>" class="<?= $active_page === $key ? 'selected' : '' ?>"><?= $link['label'] ?></a>
    <?php endforeach; ?>
    <a href="chi-tiet-tram.php#ai-mentor">AI Diagnostics</a>
  </nav>
  <div class="topbar-tools">
    <label class="search-box"><span>⌕</span><input type="search" placeholder="Tìm kiếm khóa học..." aria-label="Tìm kiếm khóa học"></label>
    <button class="icon-button" type="button" aria-label="Thông báo">♧<i></i></button>
    <div class="account-menu">
      <button class="user-chip" id="account-menu-button" type="button" aria-expanded="false" aria-controls="account-menu" aria-haspopup="true">
        <span class="avatar">DT</span>
        <span class="user-details"><strong>Đinh Thị Thùy Trâm</strong><small>Học viên</small></span>
        <span class="account-chevron" aria-hidden="true">⌄</span>
      </button>
      <div class="account-dropdown" id="account-menu" hidden>
        <div class="account-dropdown-heading">
          <span class="avatar">DT</span>
          <span><strong>Đinh Thị Thùy Trâm</strong><small>Học viên Cognita AI</small></span>
        </div>
        <div class="account-dropdown-divider"></div>
        <a class="logout-link" href="dang-xuat.php"><span aria-hidden="true">↪</span> Đăng xuất</a>
      </div>
    </div>
  </div>
</header>
<div class="app-shell">
  <aside class="sidebar">
    <a href="lo-trinh.php" class="side-brand"><span class="side-brand-icon">C</span><span><strong>Cognita Core</strong><small>Student Workspace</small></span></a>
    <div class="side-label">LEARNING SPACE</div>
    <a class="side-link <?= $active_page === 'lo-trinh' ? 'active' : '' ?>" href="lo-trinh.php"><span>◫</span> Learning Path</a>
    <a class="side-link <?= $active_page === 'chi-tiet-tram' ? 'active' : '' ?>" href="chi-tiet-tram.php"><span>◎</span> AI Assistant <b class="online-dot">Live</b></a>
    <a class="side-link <?= $active_page === 'tram-2-4' ? 'active' : '' ?>" href="tram-2-4.php"><span>▤</span> Courses &amp; Modules</a>
    <a class="side-link <?= $active_page === 'tai-lieu' ? 'active' : '' ?>" href="tai-lieu.php"><span>▧</span> Tài liệu học tập</a>
    <a class="side-link <?= $active_page === 'ket-qua' ? 'active' : '' ?>" href="ket-qua.php"><span>⌁</span> Analytics &amp; Mastery</a>
    <a class="side-link" href="ket-qua.php#milestones"><span>⚑</span> Goals &amp; Milestones</a>
    <div class="side-help"><span class="help-icon">✧</span><strong>Cần trợ giúp?</strong><p>Gia sư AI luôn sẵn sàng đồng hành cùng bạn.</p><a href="chi-tiet-tram.php#ai-mentor">Ask AI Mentor <span>→</span></a></div>
    <div class="sidebar-bottom">
      <span>⌕ &nbsp; User &amp; AIC Hub</span><span>⚙ &nbsp; System Telemetry</span><span>♢ &nbsp; Compatibility Alerts</span>
    </div>
  </aside>
  <main class="page-content">
