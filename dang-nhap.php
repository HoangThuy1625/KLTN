<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng Nhập - Cognita AI LMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="login-wrapper">

  <!-- ═══════════════════ LEFT PANEL ═══════════════════ -->
  <div class="login-left">

    <!-- Orb decorations -->
    <div style="position:absolute;top:-120px;right:-80px;width:280px;height:280px;
      background:radial-gradient(circle,rgba(108,99,255,.22) 0%,transparent 68%);
      pointer-events:none"></div>
    <div style="position:absolute;bottom:-80px;left:-60px;width:240px;height:240px;
      background:radial-gradient(circle,rgba(78,205,196,.1) 0%,transparent 65%);
      pointer-events:none"></div>

    <!-- Brand -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:26px;position:relative;z-index:1">
      <div style="width:44px;height:44px;background:linear-gradient(135deg,#6C63FF,#9C8FFF);
        border-radius:12px;display:flex;align-items:center;justify-content:center;
        box-shadow:0 4px 20px rgba(108,99,255,.5);flex-shrink:0">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
          <rect x="3" y="3" width="8" height="8" rx="2.5" fill="white" opacity="0.95"/>
          <rect x="13" y="3" width="8" height="8" rx="2.5" fill="white" opacity="0.6"/>
          <rect x="3" y="13" width="8" height="8" rx="2.5" fill="white" opacity="0.6"/>
          <rect x="13" y="13" width="8" height="8" rx="2.5" fill="white" opacity="0.3"/>
        </svg>
      </div>
      <div>
        <div style="display:flex;align-items:center;gap:7px">
          <span style="font-size:22px;font-weight:800;color:#fff;letter-spacing:-0.3px">Cognita</span>
          <span style="font-size:12px;font-weight:700;padding:2px 7px;border-radius:4px;
            background:rgba(108,99,255,.35);color:#B8B0FF;border:1px solid rgba(108,99,255,.5);letter-spacing:0.5px">AI</span>
          <span style="font-size:12px;font-weight:600;padding:2px 7px;border-radius:4px;
            background:rgba(255,255,255,.07);color:rgba(255,255,255,.45);border:1px solid rgba(255,255,255,.12);letter-spacing:0.5px">LMS</span>
        </div>
        <div style="font-size:13px;color:rgba(255,255,255,.38);margin-top:2px">AI Personalized LMS Platform</div>
      </div>
    </div>

    <!-- Badge -->
    <div style="display:inline-flex;align-items:center;gap:7px;background:rgba(108,99,255,.15);
      border:1px solid rgba(108,99,255,.28);border-radius:20px;padding:5px 13px;margin-bottom:22px;
      width:fit-content;position:relative;z-index:1">
      <div style="width:6px;height:6px;border-radius:50%;background:#7C74FF;box-shadow:0 0 7px #7C74FF"></div>
      <span style="font-size:13.5px;color:rgba(255,255,255,.6)">Đề tài Khóa luận Tốt nghiệp Ngành Kỹ thuật Phần mềm</span>
    </div>

    <!-- Heading -->
    <h2 style="font-size:24px;font-weight:800;color:#fff;line-height:1.38;letter-spacing:-0.4px;margin-bottom:12px;position:relative;z-index:1">
      Hệ thống quản lý học tập cá nhân hóa tích hợp trí tuệ nhân tạo
    </h2>
    <p style="font-size:15.5px;color:rgba(255,255,255,.5);line-height:1.65;margin-bottom:26px;position:relative;z-index:1">
      Hỗ trợ người học xây dựng lộ trình học tập phù hợp dựa trên năng lực, tiến độ và kết quả học tập.
    </p>

    <!-- Features -->
    <div style="display:flex;flex-direction:column;gap:16px;flex:1;position:relative;z-index:1">
      <?php
      $features = [
        ['🎯', 'Cá nhân hóa lộ trình học tập',
         'Thuật toán tự động phân tích điểm mạnh và đề xuất kiến thức để điều chỉnh lộ trình học tập.'],
        ['🤖', 'Trợ lý học tập AI',
         'Hỗ trợ giải đáp thắc mắc, phân tích lỗi tư duy và gợi ý tư duy đa chiều.'],
        ['📊', 'Phân tích năng lực và tiến độ',
         'Trực quan hóa mức độ làm chủ kiến thức (Mastery) và theo dõi sát sao tiến độ học tập.'],
      ];
      foreach ($features as $f): ?>
      <div style="display:flex;align-items:flex-start;gap:12px">
        <div style="width:34px;height:34px;border-radius:9px;background:rgba(108,99,255,.18);
          border:1px solid rgba(108,99,255,.25);display:flex;align-items:center;justify-content:center;
          font-size:18px;flex-shrink:0"><?= $f[0] ?></div>
        <div>
          <div style="font-size:15.5px;font-weight:700;color:rgba(255,255,255,.88);margin-bottom:3px"><?= htmlspecialchars($f[1]) ?></div>
          <div style="font-size:14px;color:rgba(255,255,255,.43);line-height:1.55"><?= htmlspecialchars($f[2]) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Bottom -->
    <div style="display:flex;justify-content:space-between;align-items:flex-end;
      margin-top:28px;padding-top:18px;border-top:1px solid rgba(255,255,255,.07);position:relative;z-index:1">
      <div style="font-size:13.5px;color:rgba(255,255,255,.35);line-height:1.6">
        <strong style="color:rgba(255,255,255,.5);font-weight:600">Mô hình học máy thích ứng</strong><br/>
        AI Knowledge Graph
      </div>
      <div style="font-size:13.5px;color:rgba(255,255,255,.35);line-height:1.6;text-align:right">
        Nghiên cứu &amp; Phát triển:<br/>
        <strong style="color:rgba(255,255,255,.5);font-weight:600">2025 – 2026</strong>
      </div>
    </div>
  </div>

  <!-- ═══════════════════ RIGHT PANEL ═══════════════════ -->
  <div class="login-right">
    <div class="login-card">

      <!-- Title -->
      <h1 style="font-size:29px;font-weight:800;color:#0F172A;margin-bottom:6px;letter-spacing:-0.4px">
        Chào mừng trở lại 👋
      </h1>
      <?php if (isset($_GET['logout']) && $_GET['logout'] === '1'): ?>
      <div role="status" style="padding:11px 13px;margin:0 0 16px;border:1px solid #B8E6D3;border-radius:9px;background:#F0FBF6;color:#157A58;font-size:14px">
        Bạn đã đăng xuất. Đăng nhập lại hoặc đăng ký tài khoản mới để tiếp tục.
      </div>
      <?php endif; ?>
      <p style="font-size:16.5px;color:#64748B;line-height:1.55;margin-bottom:24px">
        Đăng nhập để tiếp tục hành trình học tập của bạn.
      </p>

      <form id="login-form" novalidate>

        <!-- Role selector -->
        <div style="margin-bottom:22px">
          <div style="font-size:16px;font-weight:600;color:#374151;margin-bottom:9px">
            Vai trò đăng nhập <span style="color:#EF4444">*</span>
          </div>
          <div class="role-grid">
            <button type="button" class="role-btn active" id="role-sinhvien" data-role="sinhvien">
              <div class="role-icon">🎓</div>
              <div>
                <div class="role-name">Sinh viên</div>
                <div class="role-sub">Học tập cá nhân hóa</div>
              </div>
              <div class="role-check">✓</div>
            </button>
            <button type="button" class="role-btn" id="role-quantrivien" data-role="quantrivien">
              <div class="role-icon">⚙️</div>
              <div>
                <div class="role-name">Quản trị viên</div>
                <div class="role-sub">Quản lý hệ thống</div>
              </div>
              <div class="role-check" style="display:none">✓</div>
            </button>
          </div>
        </div>

        <!-- Email -->
        <div class="login-field-group">
          <label class="login-label" for="login-email">
            Địa chỉ Email <span style="color:#EF4444">*</span>
          </label>
          <div class="login-input-wrap">
            <span class="login-input-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </span>
            <input id="login-email" type="email" name="email" class="login-input"
                   placeholder="Nhập email của bạn" autocomplete="email" />
          </div>
          <span id="err-login-email" style="font-size:15px;color:#EF4444;margin-top:5px;display:none"></span>
        </div>

        <!-- Password -->
        <div class="login-field-group">
          <label class="login-label" for="login-pw">
            Mật khẩu <span style="color:#EF4444">*</span>
          </label>
          <div class="login-pw-wrap">
            <span class="login-input-icon">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </span>
            <input id="login-pw" type="password" name="mat_khau" class="login-input"
                   placeholder="Nhập mật khẩu của bạn" autocomplete="current-password"
                   style="padding-left:40px;padding-right:44px" />
            <button type="button" id="toggle-login-pw" class="login-eye-btn">
              <!-- Eye show -->
              <svg id="eye-show" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <!-- Eye hide -->
              <svg id="eye-hide" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
              </svg>
            </button>
          </div>
          <span id="err-login-pw" style="font-size:15px;color:#EF4444;margin-top:5px;display:none"></span>
        </div>

        <!-- Remember + Forgot -->
        <div class="remember-row">
          <label class="remember-label">
            <input type="checkbox" id="ghi-nho" name="ghi_nho" />
            Ghi nhớ đăng nhập
          </label>
          <a href="quen-mat-khau.php" style="font-size:16px;font-weight:600;color:#6C63FF;text-decoration:none">
            Quên mật khẩu?
          </a>
        </div>

        <!-- Submit -->
        <button type="submit" id="submit-dang-nhap" class="login-submit-btn">
          Đăng nhập
          <span class="login-arrow-badge">→</span>
        </button>

        <!-- Divider -->
        <div style="display:flex;align-items:center;gap:12px;margin:18px 0">
          <div style="flex:1;height:1px;background:#F1F5F9"></div>
          <span style="font-size:15px;color:#94A3B8;white-space:nowrap">hoặc đăng nhập thông qua</span>
          <div style="flex:1;height:1px;background:#F1F5F9"></div>
        </div>

        <!-- Google -->
        <button type="button" id="google-login" class="google-btn">
          <svg width="18" height="18" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Đăng nhập bằng Google
        </button>

        <!-- Switch -->
        <p style="text-align:center;font-size:16.5px;color:#64748B;margin:0">
          Chưa có tài khoản?
          <a href="dang-ky.php" style="color:#6C63FF;font-weight:700;text-decoration:none">Đăng ký ngay</a>
        </p>

      </form>
    </div>

    <!-- Footer -->
    <div style="margin-top:24px;font-size:14.5px;color:#94A3B8;text-align:center">
      AI Personalized LMS Platform © 2026 &nbsp;•&nbsp; Đồ án Tốt nghiệp Kỹ thuật Phần mềm
    </div>
  </div>

</div>

<script src="js/dang-nhap.js"></script>
</body>
</html>
