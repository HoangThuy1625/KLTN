<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng Ký Tài Khoản - Cognita AI LMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="auth-wrapper">

  <!-- ═══════════════════ LEFT PANEL ═══════════════════ -->
  <?php
  $current_page = 'dang-ky';
  include 'includes/left-panel.php';
  ?>

  <!-- ═══════════════════ RIGHT PANEL ═══════════════════ -->
  <main class="auth-right">

    <!-- Breadcrumb -->
    <div class="breadcrumb animate-in">
      <span class="breadcrumb-item">Trang chủ</span>
      <span class="breadcrumb-sep">›</span>
      <span class="breadcrumb-item active">👤 Đăng Ký Tài Khoản Học Viên</span>
    </div>

    <!-- Title -->
    <h1 class="page-title animate-in-delay-1">Đăng Ký Tài Khoản Học Viên</h1>
    <p class="page-subtitle animate-in-delay-1">
      Bắt đầu hành trình học tập cá nhân hóa của bạn cùng trợ lý AI thông minh.
    </p>

    <form id="dang-ky-form" novalidate>

      <!-- ── Avatar Section ── -->
      <div class="section-card animate-in-delay-2">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px">
          <span style="font-size:21px">🖼️</span>
          <span style="font-weight:700;font-size:17px;color:var(--text-dark)">Ảnh đại diện / Ảnh chân dung</span>
        </div>

        <div class="avatar-upload-area">
          <div class="avatar-preview">
            <div class="avatar-circle" id="avatar-circle">
              <div class="avatar-placeholder">
                <span class="avatar-placeholder-icon">👤</span>
                <span class="avatar-placeholder-text">Chưa có ảnh</span>
              </div>
            </div>
            <button type="button" class="avatar-edit-btn" id="avatar-edit-btn" title="Chọn ảnh">📷</button>
          </div>

          <div class="avatar-upload-info">
            <button type="button" class="upload-btn" id="upload-btn">⬆️ Tải ảnh lên</button>
            <input type="file" id="avatar-file" accept="image/jpeg,image/png,image/webp" style="display:none" />
            <p class="upload-hint">
              Vui lòng tải ảnh chân dung rõ mặt để sử dụng làm ảnh đại diện trên hệ thống
              (Hỗ trợ định dạng JPG, JPEG, PNG, WEBP).
            </p>
          </div>
        </div>
      </div>

      <!-- ── Thông tin học vấn ── -->
      <div class="section-card animate-in-delay-3">
        <div class="section-header">
          <span class="section-icon">🏛️</span>
          <h2 class="section-title">Thông tin học vấn &amp; Nhà trường</h2>
        </div>

        <!-- Trường học -->
        <div class="form-grid cols-1" style="margin-bottom:16px">
          <div class="form-group">
            <label class="form-label">Trường học <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">🏛️</span>
              <select id="truong-hoc" name="truong_hoc" class="form-select">
                <option value="">-- Chọn trường đại học / cao đẳng --</option>
              </select>
              <span class="select-arrow">▾</span>
            </div>
            <span class="form-error" id="err-truong-hoc" style="display:none"></span>
          </div>
        </div>

        <!-- Khoa + Ngành -->
        <div class="form-grid" style="margin-bottom:16px">
          <div class="form-group">
            <label class="form-label">Khoa <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">📚</span>
              <select id="khoa" name="khoa" class="form-select">
                <option value="">-- Chọn khoa của bạn --</option>
              </select>
              <span class="select-arrow">▾</span>
            </div>
            <span class="form-error" id="err-khoa" style="display:none"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Ngành học <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">🎓</span>
              <select id="nganh-hoc" name="nganh_hoc" class="form-select" disabled>
                <option value="">-- Vui lòng chọn Khoa trước --</option>
              </select>
              <span class="select-arrow">▾</span>
            </div>
            <span class="form-error" id="err-nganh-hoc" style="display:none"></span>
          </div>
        </div>

        <!-- Khóa học + MSSV -->
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Khóa học <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">📅</span>
              <select id="khoa-hoc" name="khoa_hoc" class="form-select">
                <option value="">-- Chọn khóa học --</option>
              </select>
              <span class="select-arrow">▾</span>
            </div>
            <span class="form-error" id="err-khoa-hoc" style="display:none"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Mã số sinh viên (MSSV) <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">🎫</span>
              <input type="text" id="mssv" name="mssv" class="form-input"
                     placeholder="Nhập mã số sinh viên (MSSV)..." maxlength="15" />
            </div>
            <span class="form-error" id="err-mssv" style="display:none"></span>
          </div>
        </div>
      </div>

      <!-- ── Thông tin cá nhân ── -->
      <div class="section-card animate-in-delay-4">
        <div class="section-header">
          <span class="section-icon">👤</span>
          <h2 class="section-title">Thông tin cá nhân</h2>
        </div>

        <!-- Họ tên -->
        <div class="form-grid" style="margin-bottom:16px">
          <div class="form-group span-2">
            <label class="form-label" for="ho-ten">Họ và tên <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">✏️</span>
              <input type="text" id="ho-ten" name="ho_ten" class="form-input"
                     placeholder="Nhập họ và tên đầy đủ..." />
            </div>
            <span class="form-error" id="err-ho-ten" style="display:none"></span>
          </div>
        </div>

        <!-- Ngày sinh + Giới tính -->
        <div class="form-grid" style="margin-bottom:16px">
          <div class="form-group">
            <label class="form-label" for="ngay-sinh">Ngày sinh</label>
            <div class="input-wrap">
              <span class="input-icon">🎂</span>
              <input type="date" id="ngay-sinh" name="ngay_sinh" class="form-input" max="2010-01-01" />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="gioi-tinh">Giới tính</label>
            <div class="input-wrap">
              <span class="input-icon">👥</span>
              <select id="gioi-tinh" name="gioi_tinh" class="form-select">
                <option value="">-- Chọn giới tính --</option>
              </select>
              <span class="select-arrow">▾</span>
            </div>
          </div>
        </div>

        <!-- Email + SĐT -->
        <div class="form-grid" style="margin-bottom:16px">
          <div class="form-group">
            <label class="form-label" for="email">Email <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">📧</span>
              <input type="email" id="email" name="email" class="form-input"
                     placeholder="ten@truong.edu.vn" />
            </div>
            <span class="form-error" id="err-email" style="display:none"></span>
          </div>

          <div class="form-group">
            <label class="form-label" for="sdt">Số điện thoại <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">📱</span>
              <input type="tel" id="sdt" name="so_dien_thoai" class="form-input"
                     placeholder="0xxx xxx xxx" maxlength="11" />
            </div>
            <span class="form-error" id="err-sdt" style="display:none"></span>
          </div>
        </div>
      </div>

      <!-- ── Bảo mật ── -->
      <div class="section-card animate-in-delay-4">
        <div class="section-header">
          <span class="section-icon">🔒</span>
          <h2 class="section-title">Thiết lập mật khẩu</h2>
        </div>

        <div class="form-grid">
          <!-- Mật khẩu -->
          <div class="form-group">
            <label class="form-label" for="mat-khau">Mật khẩu <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">🔑</span>
              <input type="password" id="mat-khau" name="mat_khau" class="form-input"
                     placeholder="Tối thiểu 8 ký tự..." style="padding-right:44px" />
              <button type="button" class="password-toggle" id="toggle-pw" title="Hiện mật khẩu">
                <span id="icon-pw">👁️</span>
              </button>
            </div>
            <div id="password-strength" class="password-strength" style="display:none">
              <div class="strength-bar">
                <div class="strength-fill" id="strength-fill"></div>
              </div>
              <span class="strength-text" id="strength-text"></span>
            </div>
            <span class="form-error" id="err-mat-khau" style="display:none"></span>
          </div>

          <!-- Xác nhận mật khẩu -->
          <div class="form-group">
            <label class="form-label" for="xac-nhan-mat-khau">Xác nhận mật khẩu <span class="required">*</span></label>
            <div class="input-wrap">
              <span class="input-icon">🔐</span>
              <input type="password" id="xac-nhan-mat-khau" name="xac_nhan_mat_khau" class="form-input"
                     placeholder="Nhập lại mật khẩu..." style="padding-right:44px" />
              <button type="button" class="password-toggle" id="toggle-cpw">
                <span id="icon-cpw">👁️</span>
              </button>
            </div>
            <span class="form-error" id="confirm-match" style="display:none;color:var(--success)"></span>
            <span class="form-error" id="err-xac-nhan-mat-khau" style="display:none"></span>
          </div>
        </div>
      </div>

      <!-- ── Điều khoản ── -->
      <div class="checkbox-group animate-in-delay-4" style="margin-bottom:20px">
        <input type="checkbox" id="dong-y" name="dong_y" />
        <label for="dong-y" class="checkbox-label">
          Tôi đã đọc và đồng ý với
          <a href="#">Điều khoản Dịch vụ</a>
          và
          <a href="#">Chính sách Bảo mật</a>
          của Cognita AI LMS. Tôi xác nhận thông tin đăng ký là chính xác và hợp lệ.
        </label>
      </div>
      <span class="form-error" id="err-dong-y" style="display:none;margin-bottom:12px"></span>

      <!-- ── Buttons ── -->
      <div class="btn-group animate-in-delay-4">
        <button type="button" id="reset-btn" class="btn-secondary">↺ Làm lại</button>
        <button type="submit" id="submit-dang-ky" class="btn-primary">✨ Tạo Tài Khoản Ngay</button>
      </div>

      <!-- Switch to login -->
      <p class="auth-switch">
        Đã có tài khoản? <a href="dang-nhap.php">Đăng nhập ngay →</a>
      </p>

    </form>

    <!-- Footer -->
    <footer class="auth-footer">
      <span>© 2026 Cognita AI LMS Inc. Toàn bộ quyền được bảo lưu.</span>
      <span class="auth-footer-item">🔒 Mã hóa chuẩn 256-bit SSL</span>
      <span class="auth-footer-item">🛡️ GDPR &amp; EdTech Privacy Compliant</span>
    </footer>

  </main>
</div>

<script src="js/dang-ky.js"></script>
</body>
</html>
