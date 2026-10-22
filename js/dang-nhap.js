/* ============================
   Đăng nhập - JavaScript
   ============================ */

document.addEventListener('DOMContentLoaded', () => {
  let currentRole = 'sinhvien';

  /* ─── Role selector ─── */
  const roleBtns = document.querySelectorAll('.role-btn');
  roleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      currentRole = btn.dataset.role;
      roleBtns.forEach(b => {
        const isActive = b.dataset.role === currentRole;
        b.classList.toggle('active', isActive);
        const check = b.querySelector('.role-check');
        if (check) check.style.display = isActive ? 'flex' : 'none';
      });
    });
  });

  /* ─── Toggle password ─── */
  const pwInput   = document.getElementById('login-pw');
  const toggleBtn = document.getElementById('toggle-login-pw');
  const eyeShow   = document.getElementById('eye-show');
  const eyeHide   = document.getElementById('eye-hide');

  toggleBtn.addEventListener('click', () => {
    if (pwInput.type === 'password') {
      pwInput.type  = 'text';
      eyeShow.style.display = 'none';
      eyeHide.style.display = 'block';
    } else {
      pwInput.type  = 'password';
      eyeShow.style.display = 'block';
      eyeHide.style.display = 'none';
    }
  });

  /* ─── Live clear errors ─── */
  const emailInput = document.getElementById('login-email');
  emailInput.addEventListener('input', () => {
    clearLoginError('login-email');
  });
  pwInput.addEventListener('input', () => {
    clearLoginError('login-pw');
  });

  emailInput.addEventListener('focus', () => {
    if (!emailInput.classList.contains('error-field')) {
      emailInput.style.borderColor = '#6C63FF';
      emailInput.style.boxShadow   = '0 0 0 3.5px rgba(108,99,255,.12)';
    }
  });
  emailInput.addEventListener('blur', () => {
    if (!emailInput.classList.contains('error-field')) {
      emailInput.style.borderColor = '#E2E8F0';
      emailInput.style.boxShadow   = 'none';
    }
  });
  pwInput.addEventListener('focus', () => {
    if (!pwInput.classList.contains('error-field')) {
      pwInput.style.borderColor = '#6C63FF';
      pwInput.style.boxShadow   = '0 0 0 3.5px rgba(108,99,255,.12)';
    }
  });
  pwInput.addEventListener('blur', () => {
    if (!pwInput.classList.contains('error-field')) {
      pwInput.style.borderColor = '#E2E8F0';
      pwInput.style.boxShadow   = 'none';
    }
  });

  function clearLoginError(id) {
    const el  = document.getElementById(id);
    const err = document.getElementById('err-' + id);
    if (el)  { el.classList.remove('error-field'); el.style.borderColor = '#6C63FF'; el.style.background = '#FAFBFF'; }
    if (err) { err.style.display = 'none'; }
  }

  function showLoginError(id, msg) {
    const el  = document.getElementById(id);
    const err = document.getElementById('err-' + id);
    if (el)  { el.classList.add('error-field'); el.style.borderColor = '#EF4444'; el.style.background = '#FFF8F8'; el.style.boxShadow = 'none'; }
    if (err) { err.textContent = '⚠ ' + msg; err.style.display = 'block'; }
  }

  /* ─── Submit ─── */
  document.getElementById('login-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    clearLoginError('login-email');
    clearLoginError('login-pw');

    const email  = emailInput.value.trim();
    const pw     = pwInput.value;
    let hasError = false;

    if (!email) {
      showLoginError('login-email', 'Vui lòng nhập email');
      hasError = true;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showLoginError('login-email', 'Email không hợp lệ');
      hasError = true;
    }

    if (!pw) {
      showLoginError('login-pw', 'Vui lòng nhập mật khẩu');
      hasError = true;
    }

    if (hasError) return;

    const btn = document.getElementById('submit-dang-nhap');
    btn.disabled = true;
    btn.innerHTML = 'Đang xử lý...';

    await new Promise(r => setTimeout(r, 1500));

    btn.disabled = false;
    btn.innerHTML = `Đăng nhập <span class="login-arrow-badge">→</span>`;
    const roleLabel = currentRole === 'sinhvien' ? 'Sinh viên' : 'Quản trị viên';
    alert(`Đăng nhập thành công với vai trò: ${roleLabel}!`);
  });

  /* ─── Google btn ─── */
  document.getElementById('google-login').addEventListener('click', () => {
    alert('Tính năng đăng nhập bằng Google đang được phát triển!');
  });
});
