(() => {
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
      if (event.key === 'Escape') {
        closeAccountMenu();
        accountButton.focus();
      }
    });
  }

  document.querySelectorAll('.question-cell').forEach((button) => {
    button.addEventListener('click', () => {
      const target = document.querySelector('#question-explanation');
      if (!target) return;
      const number = button.dataset.question;
      target.querySelector('strong').textContent = `✦ Câu ${String(number).padStart(2, '0')} · Phân tích câu trả lời`;
      target.querySelector('p').textContent = `Câu ${number}: AI đã ghi nhận câu trả lời của bạn. Xem lại phần kiến thức liên quan để hiểu rõ hơn về phép JOIN và cách xử lý giá trị NULL.`;
    });
  });

  const confidence = document.querySelector('.confidence input');
  if (confidence) {
    confidence.addEventListener('input', () => {
      const value = Number(confidence.value);
      const label = document.querySelector('#confidence-value');
      if (label) label.textContent = `${value}% ${value >= 75 ? 'Tự tin' : value >= 40 ? 'Khá chắc chắn' : 'Chưa chắc'}`;
    });
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
      if (code) code.textContent = question.code;
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
})();
