<?php
$page_title = 'Mastery Assessment - Cognita AI LMS';
$active_page = 'chi-tiet-tram';
$body_class = 'assessment-page';
include 'includes/lms-header.php';
?>
<div class="breadcrumbs"><span>Dashboard</span><b>›</b><span>Môn học</span><b>›</b><a href="chi-tiet-tram.php">Trạm 2.3</a><b>›</b><strong>Đánh giá năng lực vượt trạm</strong></div>
<div class="content-grid detail-grid assessment-underlay">
  <div class="main-column"><section class="section-card lesson-hero"><div><span class="eyebrow">TRẠM 2.3 · CHẶNG 2</span><h1>Phép Kết Nối Phức Tạp: Khắc Phục Cơ Chế JOIN, OUTER JOIN &amp; Xử Lý Bẫy NULL</h1><p>Học phần chuyên sâu được điều chỉnh tự động sau khi bạn hoàn thành các bài học ứng dụng.</p></div></section><section class="section-card lesson-content"><h2>Chẩn đoán nguyên nhân gốc rễ từ AI</h2><p>Bạn cần củng cố cách xử lý giá trị NULL trong phép kết nối LEFT JOIN.</p></section><section class="sql-console"><div class="console-head"><strong>SQL Interactive Playground</strong></div><div class="console-body">SELECT c.customer_name, o.order_id<br>FROM Customers c<br>LEFT JOIN Orders o ON c.customer_id = o.customer_id;</div></section></div>
  <aside class="right-column"><section class="section-card side-card"><h2>Bản đồ kiến thức</h2><p>Trạm 2.3 · OUTER JOIN &amp; NULL</p><div class="progress"><i style="width:42%"></i></div></section><section class="section-card side-card"><h2>AI Station Mentor</h2><p>Hãy xem lại quy tắc xử lý NULL trước khi làm bài kiểm tra.</p></section></aside>
</div>
<div class="assessment-backdrop" data-close-assessment>
  <section class="assessment-modal" role="dialog" aria-modal="true" aria-labelledby="assessment-title">
    <div class="modal-heading"><div><span class="eyebrow">TRẠM 2.3 · ĐÁNH GIÁ NĂNG LỰC VƯỢT TRẠM (MASTERY ASSESSMENT) <span class="pill pill-green">✦ AI Adaptive Evaluator</span></span><h1 id="assessment-title">Bài Đánh Giá Thích Ứng Vượt Trạm: Khắc Phục Cơ Chế JOIN &amp; Xử Lý Bẫy NULL</h1><p>5 câu hỏi trắc nghiệm tương tác theo thời gian <span>·</span> <strong>Ngưỡng qua trạm: 80 điểm (Mastery Score)</strong></p></div><div class="timer"><span>◷ THỜI GIAN</span><strong id="timer">09:45</strong></div><a class="modal-close" href="chi-tiet-tram.php" aria-label="Đóng bài đánh giá">×</a></div>
    <div class="quiz-progress"><span class="quiz-step active">① Câu 1</span><span class="quiz-step">② Câu 2</span><span class="quiz-step">③ Câu 3</span><span class="quiz-step">④ Câu 4</span><span class="quiz-step">⑤ Câu 5</span><div class="quiz-progress-bar"><i id="quiz-progress" style="width:20%"></i></div><small id="quiz-count">20%</small></div>
    <div class="quiz-body"><div class="question-count"><span class="question-number">01</span><strong id="question-title">Cho câu lệnh truy vấn sau trên cơ sở dữ liệu E-Commerce:</strong></div>
      <pre class="quiz-code"><span class="code-comment">-- ANSI SQL / PostgreSQL 16</span><br><span class="code-keyword">SELECT</span> c.customer_name, o.order_id, o.total_amount<br><span class="code-keyword">FROM</span> Customers c<br><span class="code-keyword">LEFT JOIN</span> Orders o <span class="code-keyword">ON</span> c.customer_id = o.customer_id<br><span class="code-keyword">WHERE</span> o.order_status = <span class="code-string">'COMPLETED'</span>;</pre>
      <p class="question-prompt" id="question-prompt">Hiện tượng gì xảy ra với những khách hàng CHƯA từng có đơn hàng nào, và tại sao?</p>
      <div class="answer-options" id="answer-options">
        <label class="answer-option"><input type="radio" name="answer" value="A"><span class="radio"></span><span><b>A.</b> Khách hàng chưa có đơn hàng vẫn được giữ lại, các cột order_id và total_amount mang giá trị NULL.</span></label>
        <label class="answer-option selected"><input type="radio" name="answer" value="B" checked><span class="radio"></span><span><b>B. LỰA CHỌN CỦA BẠN</b><br>Toàn bộ khách hàng chưa có đơn hàng bị loại bỏ bởi điều kiện lọc WHERE; LEFT JOIN trở thành INNER JOIN ngầm do điều kiện WHERE ở cột nullable.</span></label>
        <label class="answer-option"><input type="radio" name="answer" value="C"><span class="radio"></span><span><b>C.</b> Hệ thống trả về lỗi SQL Syntax Error vì không được lọc trường nullable trong mệnh đề WHERE.</span></label>
        <label class="answer-option"><input type="radio" name="answer" value="D"><span class="radio"></span><span><b>D.</b> Khách hàng chưa có đơn hàng sẽ nhận trạng thái mặc định là PENDING.</span></label>
      </div>
      <div class="hint-row"><div><strong>✧ GỢI Ý TỪ DUY TỪ AI (SCAFFOLDING)</strong><p>Hãy nghĩ lại quy tắc: <code>TRUE</code>, <code>FALSE</code>, <code>UNKNOWN</code>. Khi một dòng không khớp phép nối, giá trị ở phía bên phải có dạng gì?</p></div><div class="confidence"><span>Mức độ tự tin</span><strong id="confidence-value">85% Tự tin</strong><input type="range" min="0" max="100" value="85" aria-label="Mức độ tự tin"></div></div>
      <label class="reflection-label" for="reflection">Ghi chú tư duy phản giải của tôi</label><textarea id="reflection" placeholder="Mô tả ngắn gọn vì sao bạn chọn đáp án này..."></textarea>
    </div>
    <div class="modal-footer"><a class="button button-light" href="chi-tiet-tram.php">◉ Lưu tạm &amp; Thoát</a><div><button class="button button-light" type="button" data-ask-ai>✦ Hỏi AI gợi ý <small>(còn 2 lượt)</small></button><button class="button button-primary" type="button" id="next-question">Câu tiếp theo <span>→</span></button></div></div>
  </section>
</div>
<?php include 'includes/lms-footer.php'; ?>
