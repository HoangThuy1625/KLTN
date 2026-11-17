<?php
/**
 * Left Panel - Shared component (equivalent of LeftPanel.jsx)
 * Requires $current_page to be set by the including page.
 * Values: 'dang-ky' | 'dang-nhap' | 'quen-mat-khau'
 */
$nav_links = [
  ['href' => 'dang-ky.php',       'label' => '📝 Đăng ký tài khoản',  'key' => 'dang-ky'],
  ['href' => 'dang-nhap.php',     'label' => '🔐 Đăng nhập',          'key' => 'dang-nhap'],
  ['href' => 'quen-mat-khau.php', 'label' => '🔑 Quên mật khẩu',     'key' => 'quen-mat-khau'],
];

$features = [
  [
    'icon'       => '🎯',
    'title'      => 'Lộ trình học tập siêu cá nhân hóa',
    'badge'      => 'Adaptive',
    'badgeClass' => 'adaptive',
    'desc'       => 'Tự động phân tích năng lực xuất phát điểm qua bài test đầu vào và đề xuất trạm kiến thức tối ưu.',
  ],
  [
    'icon'       => '🤖',
    'title'      => 'AI Đồng hành 24/7',
    'badge'      => 'Real-time',
    'badgeClass' => 'realtime',
    'desc'       => 'Trợ lý gia sư AI phân tích lỗi tư duy theo thời gian thực (Zero Hallucination).',
  ],
  [
    'icon'       => '🏆',
    'title'      => 'Chứng chỉ năng lực số chuẩn quốc tế',
    'badge'      => 'Mastery',
    'badgeClass' => 'mastery',
    'desc'       => 'Đo lường mức độ làm chủ (Mastery Score) dựa trên bằng chứng dữ liệu thực tế minh bạch.',
  ],
];
?>
<aside class="auth-left">

  <!-- Brand -->
  <div class="brand">
    <div class="brand-icon">✦</div>
    <div class="brand-info">
      <div style="display:flex;align-items:center;gap:8px">
        <span class="brand-name">Cognita</span>
        <div class="brand-tags">
          <span class="brand-tag ai">AI</span>
          <span class="brand-tag lms">LMS</span>
        </div>
      </div>
      <span class="brand-subtitle">Personalized Learning Ecosystem</span>
    </div>
  </div>

  <p class="brand-desc">
    Hệ thống quản lý học tập cá nhân hóa tích hợp trí tuệ nhân tạo.
  </p>

  <!-- Feature cards -->
  <div class="feature-list">
    <?php foreach ($features as $f): ?>
    <div class="feature-card">
      <div class="feature-header">
        <div class="feature-title-group">
          <div class="feature-icon-wrap"><?= $f['icon'] ?></div>
          <span class="feature-title"><?= htmlspecialchars($f['title']) ?></span>
        </div>
        <span class="feature-badge <?= $f['badgeClass'] ?>"><?= htmlspecialchars($f['badge']) ?></span>
      </div>
      <p class="feature-desc"><?= htmlspecialchars($f['desc']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Nav links -->
  <nav class="left-nav">
    <?php foreach ($nav_links as $link): ?>
    <a href="<?= $link['href'] ?>"
       class="left-nav-link<?= ($current_page === $link['key']) ? ' active' : '' ?>">
      <?= $link['label'] ?>
    </a>
    <?php endforeach; ?>
  </nav>

</aside>
