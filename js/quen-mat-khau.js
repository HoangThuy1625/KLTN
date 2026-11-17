/* ============================
   Quên mật khẩu - JavaScript
   ============================ */

document.addEventListener('DOMContentLoaded', () => {
  let currentStep    = 1;
  let countdownTimer = null;

  const sections = {
    1: document.getElementById('step1-content'),
    2: document.getElementById('step2-content'),
    3: document.getElementById('step3-content'),
  };

  /* ─── Step navigation ─── */
  function goToStep(n) {
    currentStep = n;
    // Hide all
    Object.values(sections).forEach(s => s && (s.style.display = 'none'));
    // Show current
    if (sections[n]) sections[n].style.display = 'block';
    updateStepBar();
  }

  function updateStepBar() {
    for (let i = 1; i <= 3; i++) {
      const circle = document.getElementById('step-circle-' + i);
      const label  = document.getElementById('step-label-'  + i);
      const line   = document.getElementById('step-line-'   + i);

      circle.className = 'reset-step-circle';
      label.className  = 'reset-step-label';

      if (i < currentStep) {
        circle.className += ' done';
        circle.textContent = '✓';
        label.className  += ' done';
        if (line) line.classList.add('done');
      } else if (i === currentStep) {
        circle.className += ' active';
        circle.textContent = i;
        label.className  += ' active';
        if (line) line.classList.remove('done');
      } else {
        circle.textContent = i;
        if (line) line.classList.remove('done');
      }
    }
  }

  /* ─── Countdown ─── */
  function startCountdown(seconds) {
    let c = seconds;
    updateCountdown(c);
    countdownTimer = setInterval(() => {
      c--;
      updateCountdown(c);
      if (c <= 0) {
        clearInterval(countdownTimer);
        document.getElementById('resend-note').style.display = 'none';
        document.getElementById('resend-btn').style.display  = 'inline-block';
      }
    }, 1000);
  }

  function updateCountdown(c) {
    const note = document.getElementById('resend-note');
    const btn  = document.getElementById('resend-btn');
    if (c > 0) {
      note.style.display = 'block';
      note.innerHTML     = `⏳ Gửi lại sau <strong style="color:#6C63FF">${c}s</strong>`;
      btn.style.display  = 'none';
    }
  }

  /* ─── Error helpers ─── */
  function showErr(id, msg) {
    const input = document.getElementById(id);
    const err   = document.getElementById('err-' + id);
    if (input) input.classList.add('error-field');
    if (err)   { err.textContent = msg; err.style.display = 'block'; }
  }

  function clearErr(id) {
    const input = document.getElementById(id);
    const err   = document.getElementById('err-' + id);
    if (input) input.classList.remove('error-field');
    if (err)   { err.textContent = ''; err.style.display = 'none'; }
  }

  /* ─── STEP 1: Gửi liên kết ─── */
  const emailInput = document.getElementById('reset-email');
  emailInput.addEventListener('input', () => clearErr('reset-email'));

  document.getElementById('send-link-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErr('reset-email');

    const email = emailInput.value.trim();
    if (!email) { showErr('reset-email', 'Vui lòng nhập địa chỉ email'); return; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showErr('reset-email', 'Email không hợp lệ'); return; }

    const btn = document.getElementById('send-link-btn');
    btn.disabled = true;
    btn.textContent = 'Đang gửi...';

    await new Promise(r => setTimeout(r, 1400));

    btn.disabled = false;
    btn.innerHTML = 'Gửi liên kết đặt lại <span style="margin-left:6px">→</span>';

    // Update email display in step 2
    document.getElementById('display-email').textContent = email;

    goToStep(2);
    startCountdown(60);
  });

  /* ─── STEP 2: Đặt mật khẩu mới ─── */
  const newPwInput  = document.getElementById('new-pw');
  const confPwInput = document.getElementById('confirm-pw');

  // Toggle visibility step2
  document.getElementById('toggle-new-pw').addEventListener('click', () => {
    togglePwField(newPwInput, 'toggle-new-pw');
  });
  document.getElementById('toggle-conf-pw').addEventListener('click', () => {
    togglePwField(confPwInput, 'toggle-conf-pw');
  });

  function togglePwField(input, btnId) {
    if (input.type === 'password') {
      input.type = 'text';
      document.getElementById(btnId).innerHTML = getSvgEyeOff();
    } else {
      input.type = 'password';
      document.getElementById(btnId).innerHTML = getSvgEyeOn();
    }
  }

  newPwInput.addEventListener('input', () => {
    clearErr('new-pw');
    checkConfirmMatch();
  });
  confPwInput.addEventListener('input', () => {
    clearErr('confirm-pw');
    checkConfirmMatch();
  });

  function checkConfirmMatch() {
    const matchEl = document.getElementById('confirm-match');
    if (newPwInput.value && confPwInput.value && newPwInput.value === confPwInput.value) {
      matchEl.textContent = '✅ Mật khẩu khớp';
      matchEl.style.display = 'block';
    } else {
      matchEl.style.display = 'none';
    }
  }

  document.getElementById('resend-btn').addEventListener('click', () => {
    clearInterval(countdownTimer);
    goToStep(1);
    document.getElementById('resend-note').style.display = 'none';
    document.getElementById('resend-btn').style.display  = 'none';
  });

  document.getElementById('reset-pw-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErr('new-pw');
    clearErr('confirm-pw');

    const newPw  = newPwInput.value;
    const confPw = confPwInput.value;
    let hasError = false;

    if (!newPw) { showErr('new-pw', 'Vui lòng nhập mật khẩu mới'); hasError = true; }
    else if (newPw.length < 8) { showErr('new-pw', 'Mật khẩu tối thiểu 8 ký tự'); hasError = true; }

    if (!confPw) { showErr('confirm-pw', 'Vui lòng xác nhận mật khẩu'); hasError = true; }
    else if (newPw !== confPw) { showErr('confirm-pw', 'Mật khẩu xác nhận không khớp'); hasError = true; }

    if (hasError) return;

    const btn = document.getElementById('reset-pw-btn');
    btn.disabled = true;
    btn.textContent = 'Đang cập nhật...';

    await new Promise(r => setTimeout(r, 1500));

    clearInterval(countdownTimer);
    goToStep(3);
  });

  /* ─── SVG icons ─── */
  function getSvgEyeOn() {
    return `<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
    </svg>`;
  }

  function getSvgEyeOff() {
    return `<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
    </svg>`;
  }

  /* ─── Init ─── */
  goToStep(1);
});
