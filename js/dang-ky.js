/* ============================
   Đăng ký - JavaScript
   ============================ */

const TRUONG_HOC = [
  'Đại học Bách Khoa Hà Nội',
  'Đại học Quốc gia Hà Nội',
  'Đại học Kinh tế Quốc dân',
  'Đại học Ngoại thương',
  'Đại học Công nghệ Thông tin TP.HCM',
  'Đại học Bách Khoa TP.HCM',
  'Đại học Sư phạm Kỹ thuật TP.HCM',
  'Đại học Tôn Đức Thắng',
  'Đại học Cần Thơ',
  'Đại học Đà Nẵng',
  'Đại học Huế',
  'Đại học Thái Nguyên',
  'Đại học Vinh',
  'Đại học Duy Tân',
  'Đại học FPT',
  'Đại học RMIT Việt Nam',
  'Đại học Quốc tế Hồng Bàng',
  'Đại học Nguyễn Tất Thành',
];

const KHOA_LIST = ['Công nghệ Thông tin', 'Điện - Điện tử', 'Cơ khí', 'Kinh tế', 'Ngoại ngữ', 'Toán - Tin', 'Vật lý Kỹ thuật', 'Hóa học'];

const NGANH_THEO_KHOA = {
  'Công nghệ Thông tin': ['Kỹ thuật Phần mềm', 'Hệ thống Thông tin', 'Khoa học Máy tính', 'An toàn Thông tin', 'Trí tuệ Nhân tạo'],
  'Điện - Điện tử':      ['Điện tử Viễn thông', 'Kỹ thuật Điện', 'Điều khiển Tự động'],
  'Cơ khí':              ['Kỹ thuật Cơ khí', 'Cơ điện tử', 'Kỹ thuật Nhiệt'],
  'Kinh tế':             ['Quản trị Kinh doanh', 'Tài chính Ngân hàng', 'Kế toán - Kiểm toán', 'Marketing'],
  'default':             ['Chưa xác định'],
};

const KHOA_HOC_LIST = ['2020 - 2024', '2021 - 2025', '2022 - 2026', '2023 - 2027', '2024 - 2028'];
const GIOI_TINH_LIST = ['Nam', 'Nữ', 'Khác', 'Không muốn tiết lộ'];

const STRENGTH_LABEL = { weak: 'Yếu', fair: 'Trung bình', good: 'Khá', strong: 'Mạnh' };

/* ─── Populate selects ─── */
function populateSelect(selectEl, items, defaultText) {
  selectEl.innerHTML = `<option value="">${defaultText}</option>`;
  items.forEach(item => {
    const opt = document.createElement('option');
    opt.value = item;
    opt.textContent = item;
    selectEl.appendChild(opt);
  });
}

/* ─── Password strength ─── */
function getPasswordStrength(pw) {
  if (!pw) return null;
  let score = 0;
  if (pw.length >= 8) score++;
  if (/[A-Z]/.test(pw)) score++;
  if (/[0-9]/.test(pw)) score++;
  if (/[^A-Za-z0-9]/.test(pw)) score++;
  if (score <= 1) return 'weak';
  if (score === 2) return 'fair';
  if (score === 3) return 'good';
  return 'strong';
}

/* ─── Validation ─── */
function validateForm() {
  const errors = {};
  const get = id => document.getElementById(id);

  if (!get('truong-hoc').value) errors['truong-hoc'] = 'Vui lòng chọn trường học';
  if (!get('khoa').value)        errors['khoa']       = 'Vui lòng chọn khoa';
  if (!get('nganh-hoc').value)   errors['nganh-hoc']  = 'Vui lòng chọn ngành học';
  if (!get('khoa-hoc').value)    errors['khoa-hoc']   = 'Vui lòng chọn khóa học';
  if (!get('mssv').value.trim()) errors['mssv']        = 'Vui lòng nhập mã số sinh viên';
  if (!get('ho-ten').value.trim()) errors['ho-ten']   = 'Vui lòng nhập họ và tên';

  const email = get('email').value.trim();
  if (!email) errors['email'] = 'Vui lòng nhập email';
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors['email'] = 'Email không hợp lệ';

  const sdt = get('sdt').value.trim();
  if (!sdt) errors['sdt'] = 'Vui lòng nhập số điện thoại';
  else if (!/^(0[3|5|7|8|9])+([0-9]{8})$/.test(sdt)) errors['sdt'] = 'Số điện thoại không hợp lệ';

  const pw = get('mat-khau').value;
  if (!pw) errors['mat-khau'] = 'Vui lòng nhập mật khẩu';
  else if (pw.length < 8) errors['mat-khau'] = 'Mật khẩu tối thiểu 8 ký tự';

  const cpw = get('xac-nhan-mat-khau').value;
  if (!cpw) errors['xac-nhan-mat-khau'] = 'Vui lòng xác nhận mật khẩu';
  else if (pw !== cpw) errors['xac-nhan-mat-khau'] = 'Mật khẩu xác nhận không khớp';

  if (!get('dong-y').checked) errors['dong-y'] = 'Bạn cần đồng ý với điều khoản dịch vụ';

  return errors;
}

function showError(fieldId, msg) {
  const el = document.getElementById(fieldId);
  if (el) {
    el.classList.add('error-field');
  }
  const errEl = document.getElementById('err-' + fieldId);
  if (errEl) {
    errEl.textContent = msg ? '⚠️ ' + msg : '';
    errEl.style.display = msg ? 'flex' : 'none';
  }
}

function clearError(fieldId) {
  const el = document.getElementById(fieldId);
  if (el) el.classList.remove('error-field');
  const errEl = document.getElementById('err-' + fieldId);
  if (errEl) { errEl.textContent = ''; errEl.style.display = 'none'; }
}

function clearAllErrors() {
  const ids = ['truong-hoc','khoa','nganh-hoc','khoa-hoc','mssv','ho-ten','email','sdt','mat-khau','xac-nhan-mat-khau','dong-y'];
  ids.forEach(clearError);
}

/* ─── Init ─── */
document.addEventListener('DOMContentLoaded', () => {
  const selTruong  = document.getElementById('truong-hoc');
  const selKhoa    = document.getElementById('khoa');
  const selNganh   = document.getElementById('nganh-hoc');
  const selKhoaHoc = document.getElementById('khoa-hoc');
  const selGioiTinh = document.getElementById('gioi-tinh');

  // Populate
  populateSelect(selTruong,  TRUONG_HOC,   '-- Chọn trường đại học / cao đẳng --');
  populateSelect(selKhoa,    KHOA_LIST,    '-- Chọn khoa của bạn --');
  populateSelect(selKhoaHoc, KHOA_HOC_LIST,'-- Chọn khóa học --');
  populateSelect(selGioiTinh, GIOI_TINH_LIST, '-- Chọn giới tính --');
  selNganh.innerHTML = '<option value="">-- Vui lòng chọn Khoa trước --</option>';
  selNganh.disabled = true;

  // Trường → reset Khoa, Ngành
  selTruong.addEventListener('change', () => {
    clearError('truong-hoc');
    selKhoa.value = '';
    selNganh.innerHTML = '<option value="">-- Vui lòng chọn Khoa trước --</option>';
    selNganh.disabled = true;
  });

  // Khoa → load Ngành
  selKhoa.addEventListener('change', () => {
    clearError('khoa');
    const nganhList = NGANH_THEO_KHOA[selKhoa.value] || NGANH_THEO_KHOA['default'];
    if (selKhoa.value) {
      populateSelect(selNganh, nganhList, '-- Chọn ngành học --');
      selNganh.disabled = false;
    } else {
      selNganh.innerHTML = '<option value="">-- Vui lòng chọn Khoa trước --</option>';
      selNganh.disabled = true;
    }
    clearError('nganh-hoc');
  });

  selNganh.addEventListener('change', () => clearError('nganh-hoc'));
  selKhoaHoc.addEventListener('change', () => clearError('khoa-hoc'));

  // Live clear errors for inputs
  ['mssv','ho-ten','email','sdt'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', () => clearError(id));
  });

  // Password strength
  const matKhauEl = document.getElementById('mat-khau');
  const xacNhanEl = document.getElementById('xac-nhan-mat-khau');

  matKhauEl.addEventListener('input', () => {
    clearError('mat-khau');
    const pw = matKhauEl.value;
    const strength = getPasswordStrength(pw);
    const bar  = document.getElementById('strength-fill');
    const text = document.getElementById('strength-text');

    if (strength && pw) {
      document.getElementById('password-strength').style.display = 'block';
      bar.className  = 'strength-fill ' + strength;
      text.className = 'strength-text ' + strength;
      text.textContent = 'Độ mạnh: ' + STRENGTH_LABEL[strength];
    } else {
      document.getElementById('password-strength').style.display = 'none';
    }

    // Check confirm match
    updateConfirmStatus();
  });

  xacNhanEl.addEventListener('input', () => {
    clearError('xac-nhan-mat-khau');
    updateConfirmStatus();
  });

  function updateConfirmStatus() {
    const pw  = matKhauEl.value;
    const cpw = xacNhanEl.value;
    const el  = document.getElementById('confirm-match');
    if (el) {
      if (cpw && pw === cpw) {
        el.textContent = '✅ Mật khẩu khớp';
        el.style.color = '#22C55E';
        el.style.display = 'flex';
      } else {
        el.style.display = 'none';
      }
    }
  }

  // Toggle password visibility
  document.getElementById('toggle-pw').addEventListener('click', () => {
    const input = document.getElementById('mat-khau');
    const icon  = document.getElementById('icon-pw');
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = '🙈';
    } else {
      input.type = 'password';
      icon.textContent = '👁️';
    }
  });

  document.getElementById('toggle-cpw').addEventListener('click', () => {
    const input = document.getElementById('xac-nhan-mat-khau');
    const icon  = document.getElementById('icon-cpw');
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = '🙈';
    } else {
      input.type = 'password';
      icon.textContent = '👁️';
    }
  });

  // Avatar upload
  const fileInput  = document.getElementById('avatar-file');
  const avatarCircle = document.getElementById('avatar-circle');

  function triggerFileInput() { fileInput.click(); }
  avatarCircle.addEventListener('click', triggerFileInput);
  document.getElementById('avatar-edit-btn').addEventListener('click', triggerFileInput);
  document.getElementById('upload-btn').addEventListener('click', triggerFileInput);

  fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
      avatarCircle.innerHTML = `<img src="${ev.target.result}" alt="avatar" />`;
    };
    reader.readAsDataURL(file);
  });

  // Checkbox
  document.getElementById('dong-y').addEventListener('change', () => clearError('dong-y'));

  // Reset form
  document.getElementById('reset-btn').addEventListener('click', () => {
    document.getElementById('dang-ky-form').reset();
    avatarCircle.innerHTML = `
      <div class="avatar-placeholder">
        <span class="avatar-placeholder-icon">👤</span>
        <span class="avatar-placeholder-text">Chưa có ảnh</span>
      </div>`;
    selNganh.innerHTML = '<option value="">-- Vui lòng chọn Khoa trước --</option>';
    selNganh.disabled = true;
    document.getElementById('password-strength').style.display = 'none';
    clearAllErrors();
  });

  // Submit
  document.getElementById('dang-ky-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    clearAllErrors();
    const errors = validateForm();

    if (Object.keys(errors).length > 0) {
      Object.entries(errors).forEach(([id, msg]) => showError(id, msg));
      // Scroll to first error
      const firstErrId = Object.keys(errors)[0];
      const firstEl = document.getElementById(firstErrId);
      if (firstEl) firstEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    const btn = document.getElementById('submit-dang-ky');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner">⟳</span> Đang xử lý...';

    await new Promise(r => setTimeout(r, 1800));

    btn.disabled = false;
    btn.innerHTML = '✨ Tạo Tài Khoản Ngay';
    alert('🎉 Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
  });
});
