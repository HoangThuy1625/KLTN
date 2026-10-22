<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quên Mật Khẩu - Cognita AI LMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="reset-wrapper">

  <!-- ═══════════════════ LEFT PANEL ═══════════════════ -->
  <aside class="reset-left">
    <!-- Brand -->
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
      <div style="width:48px;height:48px;background:rgba(108,99,255,0.85);border-radius:14px;
        display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(108,99,255,0.4);flex-shrink:0">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
          <rect x="3" y="3" width="8" height="8" rx="2" fill="white" opacity="0.9"/>
          <rect x="13" y="3" width="8" height="8" rx="2" fill="white" opacity="0.6"/>
          <rect x="3" y="13" width="8" height="8" rx="2" fill="white" opacity="0.6"/>
          <rect x="13" y="13" width="8" height="8" rx="2" fill="white" opacity="0.3"/>
        </svg>
      </div>
      <div>
        <div style="display:flex;align-items:center;gap:8px">
          <span style="font-size:23px;font-weight:700;color:#fff">Cognita</span>
          <span style="font-size:13px;font-weight:700;padding:2px 8px;border-radius:5px;
            background:rgba(108,99,255,0.35);color:#A89FFF;border:1px solid rgba(108,99,255,0.5);letter-spacing:0.5px">AI</span>
          <span style="font-size:13px;font-weight:600;padding:2px 8px;border-radius:5px;
            background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);letter-spacing:0.5px">LMS</span>
        </div>
        <div style="font-size:14px;color:rgba(255,255,255,0.4);margin-top:2px">Personalized Learning Platform</div>
      </div>
    </div>

    <div style="flex:1"></div>

    <!-- Bottom card -->
    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:14px 16px">
      <div style="font-size:14px;color:rgba(255,255,255,0.4);margin-bottom:8px;font-weight:500">
        Hệ thống phân quyền 2 Roles độc lập:
      </div>
      <div style="font-size:16px;color:rgba(255,255,255,0.65);line-height:1.7">
        👨‍🎓 <strong style="color:rgba(255,255,255,0.85)">Học viên</strong> — Học tập, theo dõi tiến độ<br/>
        👨‍🏫 <strong style="color:rgba(255,255,255,0.85)">Giảng viên</strong> — Quản lý khóa học, học viên
      </div>
    </div>
  </aside>

  <!-- ═══════════════════ RIGHT PANEL ═══════════════════ -->
  <main class="reset-right">
    <div class="reset-card">

      <!-- Step bar -->
      <div class="reset-step-bar">
        <?php
        $steps = [
          1 => 'Gửi liên kết',
          2 => 'Mật khẩu mới',
          3 => 'Hoàn tất',
        ];
        $step_count = count($steps);
        $i = 0;
        foreach ($steps as $num => $label):
          $i++;
        ?>
        <div class="reset-step-item<?= $i === $step_count ? ' reset-step-last' : '' ?>">
          <div style="display:flex;align-items:center;gap:8px">
            <div class="reset-step-circle" id="step-circle-<?= $num ?>"><?= $num ?></div>
            <span class="reset-step-label" id="step-label-<?= $num ?>"><?= htmlspecialchars($label) ?></span>
          </div>
          <?php if ($i < $step_count): ?>
          <div class="reset-step-line" id="step-line-<?= $num ?>"></div>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- ── STEP 1: Gửi liên kết ── -->
      <div id="step1-content">
        <form id="send-link-form" novalidate>
          <div class="icon-circle">🔑</div>
          <h1 class="reset-title">Quên mật khẩu?</h1>
          <p class="reset-subtitle">
            Nhập email đã đăng ký để nhận liên kết đặt lại mật khẩu an toàn.
          </p>

          <div style="margin-bottom:18px">
            <label style="display:block;font-size:16px;font-weight:600;color:#374151;margin-bottom:6px">
              Địa chỉ Email
            </label>
            <div class="reset-input-wrap">
              <span class="reset-input-icon">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
              </span>
              <input id="reset-email" type="email" name="email" class="reset-input"
                     placeholder="Nhập email đã đăng ký trong hệ thống của bạn." autofocus />
            </div>
            <span id="err-reset-email" style="font-size:15px;color:#EF4444;margin-top:4px;display:none"></span>
          </div>

          <button type="submit" id="send-link-btn" class="reset-btn-primary">
            Gửi liên kết đặt lại <span style="margin-left:6px">→</span>
          </button>

          <div class="reset-bottom-nav">
            <a href="dang-nhap.php" class="reset-back-link">← Nhớ mật khẩu rồi? Quay lại đăng nhập</a>
            <a href="#" class="reset-help-link">⊕ Cần hỗ trợ?</a>
          </div>
        </form>
      </div>

      <!-- ── STEP 2: Mật khẩu mới ── -->
      <div id="step2-content" style="display:none">
        <form id="reset-pw-form" novalidate>
          <div class="icon-circle">📧</div>
          <h1 class="reset-title">Kiểm tra email</h1>
          <p class="reset-subtitle">
            Liên kết đặt lại đã gửi đến <strong style="color:#6C63FF" id="display-email"></strong>.
            Nhập mật khẩu mới của bạn bên dưới.
          </p>

          <!-- Resend countdown -->
          <div id="resend-note" class="resend-note" style="display:none"></div>
          <button type="button" id="resend-btn" class="resend-btn" style="display:none">Gửi lại liên kết →</button>

          <!-- Mật khẩu mới -->
          <div style="margin-bottom:18px">
            <label style="display:block;font-size:16px;font-weight:600;color:#374151;margin-bottom:6px">Mật khẩu mới</label>
            <div class="reset-input-wrap">
              <span class="reset-input-icon">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </span>
              <input id="new-pw" type="password" name="new_pw" class="reset-input"
                     placeholder="Tối thiểu 8 ký tự..." style="padding-right:44px" />
              <button type="button" id="toggle-new-pw" style="position:absolute;right:12px;background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
            <span id="err-new-pw" style="font-size:15px;color:#EF4444;margin-top:4px;display:none"></span>
          </div>

          <!-- Xác nhận mật khẩu -->
          <div style="margin-bottom:18px">
            <label style="display:block;font-size:16px;font-weight:600;color:#374151;margin-bottom:6px">Xác nhận mật khẩu</label>
            <div class="reset-input-wrap">
              <span class="reset-input-icon">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </span>
              <input id="confirm-pw" type="password" name="confirm_pw" class="reset-input"
                     placeholder="Nhập lại mật khẩu mới..." style="padding-right:44px" />
              <button type="button" id="toggle-conf-pw" style="position:absolute;right:12px;background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
            <span id="confirm-match" style="font-size:15px;color:#22C55E;margin-top:4px;display:none"></span>
            <span id="err-confirm-pw" style="font-size:15px;color:#EF4444;margin-top:4px;display:none"></span>
          </div>

          <button type="submit" id="reset-pw-btn" class="reset-btn-primary">
            Đặt lại mật khẩu <span style="margin-left:6px">→</span>
          </button>

          <div class="reset-bottom-nav">
            <a href="dang-nhap.php" class="reset-back-link">← Quay lại đăng nhập</a>
            <a href="#" class="reset-help-link">⊕ Cần hỗ trợ?</a>
          </div>
        </form>
      </div>

      <!-- ── STEP 3: Hoàn tất ── -->
      <div id="step3-content" style="display:none;text-align:center;padding-top:12px">
        <div style="font-size:67px;margin-bottom:20px">🎉</div>
        <h1 class="reset-title" style="text-align:center">Hoàn tất!</h1>
        <p class="reset-subtitle" style="text-align:center;margin-bottom:32px">
          Mật khẩu của bạn đã được đặt lại thành công. Hãy đăng nhập với mật khẩu mới!
        </p>
        <a href="dang-nhap.php" id="go-login-btn"
           style="display:inline-flex;align-items:center;gap:8px;
             background:linear-gradient(135deg,#5B52F0,#7C74FF);color:#fff;
             border-radius:12px;padding:13px 32px;font-weight:700;font-size:18px;
             text-decoration:none;box-shadow:0 4px 18px rgba(91,82,240,0.35)">
          🔐 Đăng nhập ngay →
        </a>
      </div>

    </div>

    <!-- Footer -->
    <footer class="reset-footer">
      © 2026 AI Personalized LMS Platform. Hệ thống quản lý học tập cá nhân hóa tích hợp trí tuệ nhân tạo.
    </footer>
  </main>

</div>

<script src="js/quen-mat-khau.js"></script>
</body>
</html>
