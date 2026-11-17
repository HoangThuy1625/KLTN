(() => {
  // Mock Mode: PHP đã xác thực server-side qua cognita_require_roles().
  // JS không redirect về login — chỉ đảm bảo localStorage đồng bộ.
  // Nếu localStorage chưa có (lần đầu hoặc sau clear cache), tự set luôn.
  if (window.CognitaMockAuth?.isEnabled()) {
    if (!window.CognitaMockAuth.isAuthenticated()) {
      window.CognitaMockAuth.login();
    }
    // Tiếp tục render trang — không return, không redirect.
  }

  const showToast = (message) => {
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.setAttribute('role', 'status');
    toast.textContent = message;
    document.body.appendChild(toast);
    window.setTimeout(() => toast.remove(), 3000);
  };

  document.querySelectorAll('[data-toast]').forEach((button) => {
    button.addEventListener('click', () => showToast(button.dataset.toast || ''));
  });

  const accountButton = document.querySelector('#account-menu-button');
  const accountMenu = document.querySelector('#account-menu');
  if (accountButton && accountMenu) {
    const closeAccountMenu = () => {
      accountButton.setAttribute('aria-expanded', 'false');
      accountMenu.hidden = true;
    };

    accountButton.addEventListener('click', () => {
      const isExpanded = accountButton.getAttribute('aria-expanded') === 'true';
      accountButton.setAttribute('aria-expanded', String(!isExpanded));
      accountMenu.hidden = isExpanded;
    });

    document.addEventListener('click', (event) => {
      if (!event.target.closest('.account-menu')) closeAccountMenu();
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && accountButton.getAttribute('aria-expanded') === 'true') {
        closeAccountMenu();
        accountButton.focus();
      }
    });
  }

  const navToggle = document.querySelector('#mobile-nav-toggle');
  const navBackdrop = document.querySelector('#sidebar-backdrop');
  if (navToggle && navBackdrop) {
    const setSidebarOpen = (isOpen) => {
      document.body.classList.toggle('sidebar-open', isOpen);
      navToggle.setAttribute('aria-expanded', String(isOpen));
      navToggle.setAttribute('aria-label', isOpen ? 'Đóng menu điều hướng' : 'Mở menu điều hướng');
      navBackdrop.hidden = !isOpen;
    };

    navToggle.addEventListener('click', () => {
      setSidebarOpen(navToggle.getAttribute('aria-expanded') !== 'true');
    });
    navBackdrop.addEventListener('click', () => {
      setSidebarOpen(false);
      navToggle.focus();
    });
    document.querySelectorAll('.sidebar .side-link').forEach((link) => {
      link.addEventListener('click', () => setSidebarOpen(false));
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && document.body.classList.contains('sidebar-open')) {
        setSidebarOpen(false);
        navToggle.focus();
      }
    });
  }

  document.querySelectorAll('.question-cell').forEach((button) => {
    button.addEventListener('click', () => {
      const target = document.querySelector('#question-explanation');
      if (!target) return;
      const number = button.dataset.question;
      const questionLabel = window.CognitaI18n?.translate('Câu') || 'Câu';
      const analysisLabel = window.CognitaI18n?.translate('Phân tích câu trả lời') || 'Phân tích câu trả lời';
      target.querySelector('strong').textContent = `✦ ${questionLabel} ${String(number).padStart(2, '0')} · ${analysisLabel}`;
      target.querySelector('p').textContent = `${questionLabel} ${number}: ${window.CognitaI18n?.translate('AI đã ghi nhận câu trả lời của bạn. Xem lại phần kiến thức liên quan để hiểu rõ hơn về phép JOIN và cách xử lý giá trị NULL.') || 'AI đã ghi nhận câu trả lời của bạn. Xem lại phần kiến thức liên quan để hiểu rõ hơn về phép JOIN và cách xử lý giá trị NULL.'}`;
    });
  });

  const confidence = document.querySelector('.confidence input');
  if (confidence) {
    const updateConfidenceLabel = () => {
      const value = Number(confidence.value);
      const label = document.querySelector('#confidence-value');
      const state = value >= 75 ? 'Tự tin' : value >= 40 ? 'Khá chắc chắn' : 'Chưa chắc';
      const translatedState = window.CognitaI18n?.translate(state) || state;
      if (label) label.textContent = `${value}% ${translatedState}`;
    };
    confidence.addEventListener('input', updateConfidenceLabel);
    document.addEventListener('cognita:languagechange', updateConfidenceLabel);
  }

  document.querySelectorAll('.answer-option input').forEach((input) => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.answer-option').forEach((option) => option.classList.remove('selected'));
      input.closest('.answer-option')?.classList.add('selected');
    });
  });

  const timer = document.querySelector('#timer');
  if (timer) {
    let remaining = 9 * 60 + 45;
    window.setInterval(() => {
      if (remaining <= 0) return;
      remaining -= 1;
      timer.textContent = `${String(Math.floor(remaining / 60)).padStart(2, '0')}:${String(remaining % 60).padStart(2, '0')}`;
    }, 1000);
  }

  const questions = [
    {
      title: 'Cho câu lệnh truy vấn sau trên cơ sở dữ liệu E-Commerce:',
      prompt: 'Hiện tượng gì xảy ra với những khách hàng CHƯA từng có đơn hàng nào, và tại sao?',
      code: "SELECT c.customer_name, o.order_id, o.total_amount\nFROM Customers c\nLEFT JOIN Orders o ON c.customer_id = o.customer_id\nWHERE o.order_status = 'COMPLETED';",
      answers: [
        'Khách hàng chưa có đơn hàng vẫn được giữ lại, các cột order_id và total_amount mang giá trị NULL.',
        'Toàn bộ khách hàng chưa có đơn hàng bị loại bỏ bởi điều kiện lọc WHERE; LEFT JOIN bị thu hẹp như INNER JOIN.',
        'Hệ thống trả về lỗi cú pháp vì không thể lọc trường nullable trong WHERE.',
        'Khách hàng chưa có đơn hàng sẽ nhận trạng thái mặc định là PENDING.'
      ]
    },
    {
      title: 'Bạn muốn giữ tất cả khách hàng và chỉ ghép các đơn hàng đã hoàn thành. Nên đặt bộ lọc ở đâu?',
      prompt: 'Chọn vị trí điều kiện để các khách hàng chưa có đơn vẫn xuất hiện trong kết quả.',
      code: "SELECT c.customer_name, o.order_id\nFROM Customers c\nLEFT JOIN Orders o ON c.customer_id = o.customer_id\n-- Thêm điều kiện lọc trạng thái tại đây",
      answers: [
        'Thêm điều kiện o.order_status = COMPLETED vào mệnh đề WHERE.',
        'Thêm điều kiện o.order_status = COMPLETED vào mệnh đề ON của phép LEFT JOIN.',
        'Đổi toàn bộ truy vấn sang INNER JOIN.',
        'Thêm điều kiện c.customer_id IS NOT NULL vào WHERE.'
      ]
    },
    {
      title: 'Khi không có bản ghi khớp ở bảng bên phải của LEFT JOIN, các cột bên phải có giá trị gì?',
      prompt: 'Hãy chọn mô tả chính xác nhất về kết quả của phép nối.',
      code: 'SELECT c.customer_id, o.order_id\nFROM Customers c\nLEFT JOIN Orders o ON c.customer_id = o.customer_id;',
      answers: [
        'Các cột từ bảng Orders có giá trị NULL.',
        'Bản ghi khách hàng bị loại khỏi kết quả.',
        'Các cột được tự động điền bằng 0.',
        'Truy vấn luôn phát sinh lỗi dữ liệu.'
      ]
    },
    {
      title: 'Điều gì xảy ra khi so sánh NULL = NULL trong điều kiện SQL thông thường?',
      prompt: 'Chọn giá trị logic được SQL trả về cho biểu thức so sánh này.',
      code: 'SELECT * FROM Orders\nWHERE shipped_at = NULL;',
      answers: [
        'TRUE, vì hai giá trị NULL giống nhau.',
        'FALSE trong mọi trường hợp.',
        'UNKNOWN; cần dùng IS NULL để kiểm tra giá trị NULL.',
        'Lỗi cú pháp trên tất cả hệ quản trị cơ sở dữ liệu.'
      ]
    },
    {
      title: 'Muốn tìm khách hàng chưa từng có đơn hàng, nên dùng mẫu truy vấn nào?',
      prompt: 'Chọn cách lọc an toàn và rõ ràng sau phép LEFT JOIN.',
      code: 'SELECT c.customer_id\nFROM Customers c\nLEFT JOIN Orders o ON c.customer_id = o.customer_id\n-- Chọn điều kiện phù hợp',
      answers: [
        'WHERE o.order_id IS NULL',
        'WHERE o.order_id = NULL',
        'WHERE o.order_id <> NULL',
        'INNER JOIN Orders o'
      ]
    }
  ];
  let currentQuestion = 0;
  const nextButton = document.querySelector('#next-question');
  if (nextButton) {
    nextButton.addEventListener('click', () => {
      if (currentQuestion >= questions.length - 1) {
        window.location.href = 'ket-qua.php';
        return;
      }
      currentQuestion += 1;
      const question = questions[currentQuestion];
      const title = document.querySelector('#question-title');
      const prompt = document.querySelector('#question-prompt');
      const code = document.querySelector('.quiz-code');
      const answers = document.querySelector('#answer-options');
      const number = currentQuestion + 1;
      if (title) title.textContent = question.title;
      if (prompt) prompt.textContent = question.prompt;
      if (code) {
        if (window.CognitaI18n) window.CognitaI18n.setCode(code, question.code);
        else code.textContent = question.code;
      }
      if (answers) {
        answers.replaceChildren(...question.answers.map((answer, index) => {
          const label = document.createElement('label');
          label.className = 'answer-option';
          label.innerHTML = `<input type="radio" name="answer" value="${String.fromCharCode(65 + index)}"><span class="radio"></span><span><b>${String.fromCharCode(65 + index)}.</b> ${answer}</span>`;
          label.querySelector('input').addEventListener('change', () => {
            answers.querySelectorAll('.answer-option').forEach((option) => option.classList.remove('selected'));
            label.classList.add('selected');
          });
          return label;
        }));
      }
      document.querySelectorAll('.quiz-step').forEach((step, index) => {
        step.classList.toggle('active', index === currentQuestion);
      });
      const progress = document.querySelector('#quiz-progress');
      const count = document.querySelector('#quiz-count');
      const percent = number * 20;
      if (progress) progress.style.width = `${percent}%`;
      if (count) count.textContent = `${percent}%`;
      const questionNumber = document.querySelector('.question-number');
      if (questionNumber) questionNumber.textContent = String(number).padStart(2, '0');
      if (number === questions.length) nextButton.innerHTML = 'Hoàn thành <span>✓</span>';
    });
  }

  document.querySelector('[data-ask-ai]')?.addEventListener('click', () => {
    showToast('Gợi ý: điều kiện ở WHERE lọc sau khi JOIN. Hãy nghĩ xem dòng không khớp sẽ có giá trị nào.');
  });

  document.querySelector('[data-run-sql]')?.addEventListener('click', () => {
    const output = document.querySelector('.sql-output');
    if (output) {
      output.hidden = false;
      output.textContent = 'Query executed in read-only sandbox.\n3 rows returned · 0.02 sec';
    }
  });

  document.querySelectorAll('[data-close-assessment]').forEach((backdrop) => {
    backdrop.addEventListener('click', (event) => {
      if (event.target === backdrop) window.location.href = 'chi-tiet-tram.php';
    });
  });

  document.querySelectorAll('[data-question-filter]').forEach((button) => {
    button.addEventListener('click', () => {
      const filter = button.dataset.questionFilter;
      document.querySelectorAll('[data-question-filter]').forEach((item) => item.classList.toggle('active', item === button));
      document.querySelectorAll('.mastery-question').forEach((question) => {
        question.hidden = filter === 'challenge' && question.dataset.questionType !== 'challenge';
      });
    });
  });

  const documentInput = document.querySelector('#document-file');
  const dropzone = document.querySelector('#upload-dropzone');
  const selectedFile = document.querySelector('#selected-file');
  const uploadFeedback = document.querySelector('#upload-feedback');
  let validDocument = null;
  const showUploadFeedback = (message, isError = false) => {
    if (!uploadFeedback) return;
    uploadFeedback.hidden = false;
    uploadFeedback.textContent = message;
    uploadFeedback.classList.toggle('error', isError);
  };
  const displayDocument = (file) => {
    if (!file || !selectedFile) return;
    const extension = file.name.split('.').pop().toLowerCase();
    const supported = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt'];
    if (!supported.includes(extension)) {
      validDocument = null;
      selectedFile.hidden = true;
      showUploadFeedback('Định dạng tệp chưa được hỗ trợ. Vui lòng chọn PDF, DOC, DOCX, PPT, PPTX hoặc TXT.', true);
      return;
    }
    if (file.size > 20 * 1024 * 1024) {
      validDocument = null;
      selectedFile.hidden = true;
      showUploadFeedback('Tệp vượt quá giới hạn 20 MB. Vui lòng chọn tài liệu có dung lượng nhỏ hơn.', true);
      return;
    }
    validDocument = file;
    selectedFile.hidden = false;
    selectedFile.replaceChildren(
      document.createTextNode('✓ '),
      document.createTextNode(file.name),
      document.createTextNode(' · '),
      document.createTextNode((file.size / (1024 * 1024)).toFixed(2)),
      document.createTextNode(' MB')
    );
    if (uploadFeedback) uploadFeedback.hidden = true;
  };
  if (documentInput && dropzone) {
    document.querySelector('#choose-document')?.addEventListener('click', (event) => {
      event.stopPropagation();
      documentInput.click();
    });
    documentInput.addEventListener('change', () => displayDocument(documentInput.files[0]));
    dropzone.addEventListener('click', (event) => {
      if (event.target.closest('button')) return;
      documentInput.click();
    });
    dropzone.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        documentInput.click();
      }
    });
    ['dragenter', 'dragover'].forEach((eventName) => dropzone.addEventListener(eventName, (event) => {
      event.preventDefault();
      dropzone.classList.add('drag-over');
    }));
    ['dragleave', 'drop'].forEach((eventName) => dropzone.addEventListener(eventName, (event) => {
      event.preventDefault();
      dropzone.classList.remove('drag-over');
    }));
    dropzone.addEventListener('drop', (event) => {
      const file = event.dataTransfer?.files[0];
      if (file) displayDocument(file);
    });
  }
  document.querySelector('#document-upload-form')?.addEventListener('submit', (event) => {
    event.preventDefault();
    const title = document.querySelector('#document-title');
    const course = document.querySelector('#document-course');
    if (!validDocument) {
      showUploadFeedback('Vui lòng chọn một tệp tài liệu hợp lệ trước khi bắt đầu phân tích.', true);
      dropzone?.focus();
      return;
    }
    if (!title.value.trim() || !course.value) {
      showUploadFeedback('Vui lòng nhập tên tài liệu và chọn môn học tương ứng.', true);
      return;
    }
    uploadFeedback.replaceChildren(
      document.createTextNode('Tệp “'),
      document.createTextNode(validDocument.name),
      document.createTextNode('” đã được kiểm tra trên trình duyệt. Đây là bản demo giao diện; chưa tải tệp lên máy chủ.')
    );
    uploadFeedback.hidden = false;
    uploadFeedback.classList.remove('error');
  });
  document.querySelector('#document-upload-form')?.addEventListener('reset', () => {
    validDocument = null;
    if (documentInput) documentInput.value = '';
    if (selectedFile) selectedFile.hidden = true;
    if (uploadFeedback) uploadFeedback.hidden = true;
  });
  document.querySelectorAll('[data-document-action]').forEach((button) => {
    button.addEventListener('click', () => showToast(`${button.dataset.documentAction}: tính năng tài liệu đang ở chế độ bản demo.`));
  });

  document.querySelectorAll('[data-transaction-tab]').forEach((tab) => {
    tab.addEventListener('click', () => {
      const target = tab.dataset.transactionTab;
      if (target === 'assessment') {
        showToast('Hoàn thành các bước học tập để mở bài đánh giá Trạm 2.4.');
        return;
      }
      document.querySelectorAll('.transaction-tabs [data-transaction-tab]').forEach((item) => item.classList.toggle('selected', item.dataset.transactionTab === target));
      document.querySelector(target === 'simulator' ? '#simulator' : '#roadmap')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
  const simulationMessage = document.querySelector('.simulation-message');
  const simulationStatus = document.querySelector('.lock-status');
  const simulationDescription = document.querySelector('.lock-state > div');
  const showSimulationMessage = (message) => {
    if (!simulationMessage) return;
    simulationMessage.hidden = false;
    simulationMessage.textContent = message;
  };
  document.querySelector('[data-run-simulation]')?.addEventListener('click', () => {
    document.querySelector('.session-panel.session-b')?.classList.add('transaction-waiting');
    if (simulationStatus) simulationStatus.textContent = '● Session B đang chờ khóa được giải phóng';
    showSimulationMessage('Mô phỏng hoàn tất: T1 giữ X-Lock trên Row #42; T2 chờ cho đến khi T1 COMMIT.');
  });
  document.querySelector('[data-inject-deadlock]')?.addEventListener('click', () => {
    document.querySelector('.transaction-sessions')?.classList.add('deadlock-detected');
    if (simulationStatus) simulationStatus.textContent = '⚠ Deadlock phát hiện: Wait-For Graph có chu trình';
    if (simulationDescription) simulationDescription.textContent = 'Deadlock: T1 chờ tài nguyên của T2 · T2 chờ tài nguyên của T1';
    showSimulationMessage('Deadlock được phát hiện trong sandbox mô phỏng. PostgreSQL sẽ chọn một transaction làm nạn nhân và rollback để phá chu trình.');
  });
  document.querySelector('[data-reset-simulation]')?.addEventListener('click', () => {
    document.querySelector('.transaction-sessions')?.classList.remove('deadlock-detected');
    document.querySelector('.session-panel.session-b')?.classList.remove('transaction-waiting');
    if (simulationStatus) simulationStatus.textContent = '● Wait-For Graph: Không phát hiện chu trình Deadlock (No cycle)';
    if (simulationDescription) simulationDescription.textContent = 'Lock(Row#42, Mode: Exclusive, Holder: Tx10482, Waiters: [Tx10483])';
    if (simulationMessage) simulationMessage.hidden = true;
  });
  document.querySelector('[data-jump-simulator]')?.addEventListener('click', () => document.querySelector('#simulator')?.scrollIntoView({ behavior: 'smooth' }));
  document.querySelector('[data-start-module]')?.addEventListener('click', () => {
    document.querySelector('#roadmap')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    showToast('Bắt đầu học Trạm 2.4: hoàn thành 5 bước để mở bài đánh giá.');
  });
  document.querySelector('[data-step-start]')?.addEventListener('click', (event) => {
    event.currentTarget.closest('.micro-step')?.classList.add('step-in-progress');
    const progress = document.querySelector('#step-progress');
    if (progress) progress.textContent = '1 / 5';
    event.currentTarget.textContent = 'Đang học';
    event.currentTarget.disabled = true;
    showToast('Bài học về ACID và Write-Ahead Logging đã bắt đầu.');
  });
  document.querySelectorAll('[data-mentor-question]').forEach((button) => {
    button.addEventListener('click', () => {
      const message = document.querySelector('.mentor-message');
      if (message) message.replaceChildren(
        document.createTextNode('Câu hỏi của bạn: '),
        document.createTextNode(window.CognitaI18n?.getOriginalText(button) || button.textContent.trim()),
        document.createTextNode(' Hãy bắt đầu bằng cách phân tích hiện tượng tranh chấp tài nguyên và mức độ cô lập đang được sử dụng.')
      );
    });
  });
  document.querySelector('[data-mentor-form]')?.addEventListener('submit', (event) => {
    event.preventDefault();
    const input = event.currentTarget.querySelector('input');
    if (!input.value.trim()) {
      input.focus();
      return;
    }
    const message = document.querySelector('.mentor-message');
    if (message) message.replaceChildren(
      document.createTextNode('Câu hỏi của bạn: '),
      document.createTextNode(input.value.trim()),
      document.createTextNode(' AI Mentor sẽ hướng dẫn bạn từng bước trong bản demo này.')
    );
    input.value = '';
  });

  const userSearch = document.querySelector('#admin-user-search');
  const roleFilter = document.querySelector('#admin-role-filter');
  const statusFilter = document.querySelector('#admin-status-filter');
  const filterUsers = () => {
    const query = userSearch?.value.trim().toLocaleLowerCase('vi') || '';
    const role = roleFilter?.value || 'all';
    const status = statusFilter?.value || 'all';
    document.querySelectorAll('.admin-user-row').forEach((row) => {
      const matchesQuery = row.dataset.search.toLocaleLowerCase('vi').includes(query);
      const matchesRole = role === 'all' || row.dataset.role === role;
      const matchesStatus = status === 'all' || row.dataset.status === status;
      row.hidden = !(matchesQuery && matchesRole && matchesStatus);
    });
    const visibleRows = [...document.querySelectorAll('.admin-user-row')].some((row) => !row.hidden);
    const emptyRow = document.querySelector('#admin-no-results');
    if (emptyRow) emptyRow.hidden = visibleRows;
  };
  [userSearch, roleFilter, statusFilter].forEach((control) => {
    control?.addEventListener(control === userSearch ? 'input' : 'change', filterUsers);
  });

  document.querySelector('[data-add-user]')?.addEventListener('click', () => {
    const form = document.querySelector('#add-user-form');
    if (!form) return;
    form.hidden = !form.hidden;
    if (!form.hidden) form.querySelector('input')?.focus();
  });
  document.querySelector('#add-user-form')?.addEventListener('submit', (event) => {
    event.preventDefault();
    const form = event.currentTarget;
    const formData = new FormData(form);
    const name = String(formData.get('name')).trim();
    const email = String(formData.get('email')).trim();
    const role = String(formData.get('role'));
    const feedback = document.querySelector('#add-user-feedback');
    const duplicate = [...document.querySelectorAll('.admin-user-row')].some((row) => row.dataset.email.toLowerCase() === email.toLowerCase());
    if (duplicate) {
      feedback.hidden = false;
      feedback.textContent = 'Email này đã có trong danh sách.';
      form.elements.email.focus();
      return;
    }
    const row = document.createElement('tr');
    const roleLabel = role === 'admin' ? 'Quản trị viên' : 'Người học';
    row.className = 'admin-user-row';
    Object.assign(row.dataset, {
      search: `${name} ${email}`,
      name,
      email,
      role,
      roleLabel,
      status: 'active',
      statusLabel: 'Đang hoạt động',
    });
    const identityCell = document.createElement('td');
    const nameLabel = document.createElement('strong');
    nameLabel.className = 'admin-user-name';
    nameLabel.textContent = name;
    const emailLabel = document.createElement('small');
    emailLabel.className = 'admin-user-email';
    emailLabel.textContent = email;
    identityCell.append(nameLabel, emailLabel);
    const roleCell = document.createElement('td');
    const roleBadge = document.createElement('span');
    roleBadge.className = `admin-role${role === 'admin' ? ' is-admin' : ''}`;
    roleBadge.textContent = roleLabel;
    roleCell.append(roleBadge);
    const progressCell = document.createElement('td');
    progressCell.textContent = role === 'admin' ? 'Toàn quyền' : '0%';
    const statusCell = document.createElement('td');
    const statusBadge = document.createElement('span');
    statusBadge.className = 'admin-status';
    statusBadge.textContent = '● Đang hoạt động';
    statusCell.append(statusBadge);
    const actionCell = document.createElement('td');
    const actionButton = document.createElement('button');
    actionButton.className = 'admin-table-actions';
    actionButton.type = 'button';
    actionButton.dataset.userAction = 'Chi tiết người dùng';
    actionButton.textContent = 'Chi tiết';
    actionButton.addEventListener('click', () => showToast('Chi tiết người dùng: dữ liệu đang ở chế độ demo.'));
    actionCell.append(actionButton);
    row.append(identityCell, roleCell, progressCell, statusCell, actionCell);
    document.querySelector('#admin-user-list').insertBefore(row, document.querySelector('#admin-no-results'));
    form.reset();
    form.hidden = true;
    feedback.hidden = true;
    filterUsers();
    showToast('Đã thêm người dùng vào danh sách mẫu của phiên này.');
  });
  document.querySelectorAll('[data-user-action]').forEach((button) => {
    button.addEventListener('click', () => showToast(`${button.dataset.userAction}: dữ liệu đang ở chế độ demo.`));
  });
  document.querySelector('[data-ai-audit]')?.addEventListener('click', () => {
    showToast('AI Audit demo đã hoàn tất: không phát hiện bất thường nghiêm trọng.');
  });
  document.querySelector('[data-admin-export]')?.addEventListener('click', () => {
    const rows = [...document.querySelectorAll('.admin-user-row:not([hidden])')];
    const csv = [['Họ tên', 'Email', 'Vai trò', 'Trạng thái'], ...rows.map((row) => [
      row.dataset.name,
      row.dataset.email,
      row.dataset.roleLabel,
      row.dataset.statusLabel,
    ])].map((fields) => fields.map((field) => `"${String(field).replaceAll('"', '""')}"`).join(',')).join('\n');
    const link = document.createElement('a');
    const csvUrl = URL.createObjectURL(new Blob(['\ufeff', csv], { type: 'text/csv;charset=utf-8' }));
    link.href = csvUrl;
    link.download = 'cognita-users.csv';
    link.click();
    window.setTimeout(() => URL.revokeObjectURL(csvUrl), 1000);
  });

  const logoutDialog = document.querySelector('#logout-dialog');
  if (logoutDialog) {
    document.querySelector('#cancel-logout')?.focus();
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') window.location.href = 'lo-trinh.php';
      if (event.key === 'Tab') {
        const controls = [...logoutDialog.querySelectorAll('a[href], button:not([disabled])')];
        if (controls.length && event.shiftKey && document.activeElement === controls[0]) {
          event.preventDefault();
          controls[controls.length - 1].focus();
        } else if (controls.length && !event.shiftKey && document.activeElement === controls[controls.length - 1]) {
          event.preventDefault();
          controls[0].focus();
        }
      }
    });
  }
})();
