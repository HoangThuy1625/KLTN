<?php
$page_title = 'Tổng quan quản trị - Cognita AI LMS';
$active_page = 'quan-tri';
$is_admin = true;
include 'includes/lms-header.php';
?>
<div class="breadcrumbs"><span>Quản trị hệ thống</span><b>›</b><strong>Tổng quan</strong></div>
<div class="admin-heading">
  <div><span class="eyebrow">ADMIN CONSOLE · V4.8</span><h1>Tổng Quan Hệ Thống Quản Trị</h1><p>Trung tâm điều hành và phân quyền học tập tích hợp AI. Dữ liệu hiển thị là dữ liệu mẫu.</p></div>
  <div class="admin-actions"><button class="button button-light" type="button" data-admin-export>⇩ Xuất báo cáo</button><button class="button button-primary" type="button" data-ai-audit>✦ Khởi chạy AI Audit</button></div>
</div>
<section class="admin-metrics" aria-label="Chỉ số hệ thống">
  <article class="admin-metric"><span>Tổng số người dùng <b>♙</b></span><strong>12,480</strong><small>↗ +14% tháng này · 3,120 đang hoạt động</small></article>
  <article class="admin-metric"><span>Tổng số môn học <b>▤</b></span><strong>38</strong><small>240 chương · 1,450 bài giảng</small></article>
  <article class="admin-metric"><span>Tương tác AI cá nhân hóa <b>✦</b></span><strong>482,900</strong><small>Độ chính xác: 94.6%</small></article>
  <article class="admin-metric"><span>Bài kiểm tra đã chấm <b>✓</b></span><strong>45,210</strong><small>Điểm trung bình khóa: 7.62 / 10</small></article>
</section>
<div class="admin-grid">
  <section class="section-card" id="users">
    <div class="section-heading"><div><h2>Bảng Quản Lý Người Dùng &amp; Phân Quyền (RBAC)</h2><p class="text-muted">Kiểm soát người học và cấp quyền quản trị viên.</p></div><button class="button button-primary button-small" type="button" data-add-user>♙ + Thêm người dùng mới</button></div>
    <div class="admin-user-tools">
      <input id="admin-user-search" type="search" placeholder="Tìm tên hoặc email sinh viên..." aria-label="Tìm theo tên hoặc email">
      <select id="admin-role-filter" aria-label="Lọc theo vai trò"><option value="all">Tất cả vai trò</option><option value="student">Người học</option><option value="admin">Quản trị viên</option></select>
      <select id="admin-status-filter" aria-label="Lọc theo trạng thái"><option value="all">Tất cả trạng thái</option><option value="active">Đang hoạt động</option><option value="locked">Tạm khóa</option></select>
    </div>
    <form class="admin-add-user-form" id="add-user-form" hidden>
      <label>Họ và tên<input name="name" type="text" autocomplete="name" required maxlength="80"></label>
      <label>Email<input name="email" type="email" autocomplete="email" required maxlength="120"></label>
      <label>Vai trò<select name="role"><option value="student">Người học</option><option value="admin">Quản trị viên</option></select></label>
      <button class="button button-primary button-small" type="submit">Thêm tài khoản</button>
      <p class="admin-form-feedback" id="add-user-feedback" role="status" hidden></p>
    </form>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead><tr><th scope="col">Người dùng</th><th scope="col">Vai trò</th><th scope="col">Tiến độ / quyền</th><th scope="col">Trạng thái</th><th scope="col"><span class="visually-hidden">Thao tác</span></th></tr></thead>
        <tbody id="admin-user-list">
          <tr class="admin-user-row" data-search="Nguyễn Văn An an.nguyen@edu.vn" data-name="Nguyễn Văn An" data-email="an.nguyen@edu.vn" data-role="student" data-role-label="Người học" data-status="active" data-status-label="Đang hoạt động"><td><strong class="admin-user-name">Nguyễn Văn An</strong><small class="admin-user-email">an.nguyen@edu.vn</small></td><td><span class="admin-role">Người học</span></td><td><div class="admin-progress"><span class="progress"><i style="width:62%"></i></span><small>62%</small></div></td><td><span class="admin-status">● Đang hoạt động</span></td><td><button class="admin-table-actions" type="button" data-user-action="Chi tiết người dùng">Chi tiết</button></td></tr>
          <tr class="admin-user-row" data-search="Lê Thu Trang trang.le@edu.vn" data-name="Lê Thu Trang" data-email="trang.le@edu.vn" data-role="student" data-role-label="Người học" data-status="active" data-status-label="Đang hoạt động"><td><strong class="admin-user-name">Lê Thu Trang</strong><small class="admin-user-email">trang.le@edu.vn</small></td><td><span class="admin-role">Người học</span></td><td><div class="admin-progress"><span class="progress"><i class="green-bar" style="width:88%"></i></span><small>88%</small></div></td><td><span class="admin-status">● Đang hoạt động</span></td><td><button class="admin-table-actions" type="button" data-user-action="Chi tiết người dùng">Chi tiết</button></td></tr>
          <tr class="admin-user-row" data-search="Trần Minh Hoàng hoang.tran@edu.vn" data-name="Trần Minh Hoàng" data-email="hoang.tran@edu.vn" data-role="admin" data-role-label="Quản trị viên" data-status="active" data-status-label="Đang hoạt động"><td><strong class="admin-user-name">Trần Minh Hoàng</strong><small class="admin-user-email">hoang.tran@edu.vn</small></td><td><span class="admin-role is-admin">Quản trị viên</span></td><td><span class="admin-role is-admin">Toàn quyền</span></td><td><span class="admin-status">● Đang hoạt động</span></td><td><button class="admin-table-actions" type="button" data-user-action="Chi tiết người dùng">Chi tiết</button></td></tr>
          <tr class="admin-user-row" data-search="Vũ Đức Minh minh.vu@edu.vn" data-name="Vũ Đức Minh" data-email="minh.vu@edu.vn" data-role="student" data-role-label="Người học" data-status="locked" data-status-label="Tạm khóa"><td><strong class="admin-user-name">Vũ Đức Minh</strong><small class="admin-user-email">minh.vu@edu.vn</small></td><td><span class="admin-role">Người học</span></td><td><div class="admin-progress"><span class="progress"><i class="red-bar" style="width:24%"></i></span><small>24%</small></div></td><td><span class="admin-status is-locked">● Tạm khóa</span></td><td><button class="admin-table-actions" type="button" data-user-action="Chi tiết người dùng">Chi tiết</button></td></tr>
          <tr id="admin-no-results" hidden><td colspan="5">Không tìm thấy người dùng phù hợp.</td></tr>
        </tbody>
      </table>
    </div>
  </section>
  <section class="section-card" id="quiz-bank">
    <div class="section-heading compact"><div><span class="eyebrow">QUIZ BANK</span><h2>Ngân Hàng Bài Kiểm Tra Tích Hợp AI</h2></div><span class="pill pill-lavender">3 đang thi</span></div>
    <div class="admin-quiz-list">
      <article class="admin-quiz-item"><div class="admin-quiz-head"><strong>Đánh giá năng lực SQL &amp; Cơ sở dữ liệu</strong><span class="pill pill-green">81% Đạt</span></div><p>25 câu · 3,420 lượt thi</p><div class="admin-quiz-meta"><span>Adaptive: On</span><span>Cập nhật hôm nay</span></div></article>
      <article class="admin-quiz-item"><div class="admin-quiz-head"><strong>Thuật toán &amp; Cấu trúc dữ liệu C++</strong><span class="pill pill-green">68% Đạt</span></div><p>30 câu · 2,890 lượt thi</p><div class="admin-quiz-meta"><span>Strict Timer</span><span>Cập nhật 2 ngày trước</span></div></article>
      <article class="admin-quiz-item"><div class="admin-quiz-head"><strong>Lập trình hướng đối tượng Java</strong><span class="pill pill-green">74% Đạt</span></div><p>20 câu · 4,110 lượt thi</p><div class="admin-quiz-meta"><span>Auto-Grade</span><span>Cập nhật tuần này</span></div></article>
    </div>
    <button class="button button-light button-full" type="button" data-toast="Danh sách ngân hàng câu hỏi đang hiển thị dữ liệu mẫu.">Xem ngân hàng câu hỏi</button>
  </section>
</div>
<section class="admin-audit" id="ai-audit">
  <div><span class="pill pill-lavender">AI AUTO-QUESTION ENGINE · ● LIVE</span><h2>Tính năng AI tự động sinh câu hỏi theo độ khó thích ứng đang kích hoạt</h2><p>Thuật toán tự động quét giáo trình, phân tích cấu trúc câu hỏi và theo dõi độ tin cậy của mô hình trên dữ liệu mẫu.</p></div>
  <button class="button" type="button" data-ai-audit>✦ Chạy AI Audit</button>
</section>
<?php include 'includes/lms-footer.php'; ?>