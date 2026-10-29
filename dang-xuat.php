<?php
$page_title = 'Xác nhận đăng xuất - Cognita AI LMS';
$active_page = 'tai-lieu';
$body_class = 'logout-page';
include 'includes/lms-header.php';
?>
<div class="breadcrumbs"><span>Dashboard</span><b>›</b><span>Cài đặt tài khoản</span><b>›</b><strong>Bảo mật &amp; Phiên đăng nhập</strong></div>
<div class="security-page-underlay">
  <div class="security-heading"><div><span class="eyebrow">CÀI ĐẶT TÀI KHOẢN</span><h1>Cài đặt Bảo mật &amp; Quản lý Phiên Đăng xuất</h1><p>Quản lý phiên đăng nhập đang hoạt động và bảo vệ không gian học tập Cognita AI của bạn.</p></div><span class="pill pill-green">● Tài khoản an toàn</span></div>
  <div class="security-content-grid"><section class="section-card"><h2>Phiên đăng nhập đang hoạt động</h2><p class="text-muted">Thiết bị và vị trí đã đăng nhập vào tài khoản của bạn.</p><article class="security-session"><span>▣</span><div><strong>Máy tính này · Windows</strong><small>Chrome · Phiên hiện tại · Hoạt động ngay bây giờ</small></div><span class="pill pill-green">Hiện tại</span></article><article class="security-session"><span>▤</span><div><strong>Thiết bị di động</strong><small>Đăng nhập lần cuối: 2 ngày trước</small></div><button class="button button-light button-small" type="button">Đăng xuất thiết bị</button></article></section><section class="section-card"><h2>Bảo vệ tài khoản</h2><p>Phiên học tập của bạn được đồng bộ an toàn giữa các thiết bị.</p><div class="security-setting"><span>◈</span><div><strong>Xác thực hai yếu tố</strong><small>Đang bật · Tăng cường bảo vệ tài khoản</small></div><span class="pill pill-green">Đã bật</span></div><div class="security-setting"><span>▣</span><div><strong>Đồng bộ tiến độ học tập</strong><small>Dữ liệu được lưu tự động</small></div><span class="pill pill-green">Đang bật</span></div></section></div>
</div>
<div class="logout-backdrop" id="logout-dialog">
  <section class="logout-modal" role="dialog" aria-modal="true" aria-labelledby="logout-title" aria-describedby="logout-description">
    <div class="logout-symbol" aria-hidden="true">⇥</div>
    <h2 id="logout-title">Xác nhận đăng xuất?</h2>
    <p id="logout-description">Bạn có chắc chắn muốn đăng xuất khỏi tài khoản của mình không? Mọi tiến trình học tập và phiên bản mới nhất của bạn sẽ được đồng bộ và kết thúc an toàn.</p>
    <div class="logout-user-card"><span class="avatar logout-avatar">DT</span><span><strong>Đinh Thị Thùy Trâm</strong><small>MSSV: 20291126013 · K29 Kỹ thuật phần mềm<br>(ĐH Duy Tân) · Sinh viên (Student)</small></span><b aria-label="Tài khoản đã xác minh">◉</b></div>
    <div class="logout-actions"><a class="button button-light" href="lo-trinh.php" id="cancel-logout">Hủy</a><a class="button logout-confirm" href="dang-nhap.php?logout=1">Đăng xuất <span>→</span></a></div>
    <div class="logout-security-note">♙ Khóa phiên bảo mật 256-bit <b>•</b> Hủy cookie tức thì</div>
  </section>
</div>
<?php include 'includes/lms-footer.php'; ?>
