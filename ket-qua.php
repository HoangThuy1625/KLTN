<?php
$page_title = 'Kết quả vượt Trạm 2.3 - Cognita AI LMS';
$active_page = 'ket-qua';
$body_class = 'mastery-result-page';
include 'includes/lms-header.php';
$questions = [
  ['Khắc phục cơ chế LEFT JOIN &amp; WHERE với tập giá trị NULL', 'Khái niệm · LEFT JOIN · Execution Plan', 'Đặt điều kiện lọc trạng thái khách hàng kích hoạt vào mệnh đề ON thay vì WHERE để bảo toàn toàn bộ danh mục khách hàng.', 'SELECT u.id, u.name, o.order_id FROM users u LEFT JOIN orders o ON u.id = o.user_id AND o.status = \'COMPLETED\';', '1m 12s'],
  ['Bài toán bảo toàn dòng khuyết với COALESCE trong PostgreSQL', 'Khái niệm · NULL · Fallback Defaults', 'Ứng dụng hàm COALESCE(SUM(amount), 0) kết hợp LEFT JOIN để tránh hiển thị NULL trong báo cáo doanh số.', 'COALESCE(SUM(amount), 0)', '48s'],
  ['Phân biệt RIGHT JOIN và FULL OUTER JOIN trên schema E-Commerce', 'Khái niệm · Join · Execution Plan', 'FULL OUTER JOIN bảo toàn bản ghi ở cả hai phía, phù hợp để tìm dữ liệu khuyết trong danh mục khách hàng và đơn hàng.', 'FULL OUTER JOIN customers c ON c.id = o.customer_id', '1m 35s'],
  ['Anti-JOIN pattern sử dụng WHERE ... IS NULL', 'Khái niệm · NULL · Query Design', 'Tìm các khách hàng chưa có đơn hàng bằng LEFT JOIN và WHERE right_table.pk IS NULL, thay cho truy vấn con NOT IN.', 'WHERE right_table.pk IS NULL', '1m 05s'],
  ['Tối ưu truy vấn OUTER JOIN đa bảng kết hợp GROUP BY &amp; Index Scan', 'Khái niệm · Execution Plan · Index Scan', 'Kết hợp GROUP BY, Index Scan và LEFT JOIN để tổng hợp doanh số từng khách hàng; lộ trình học gợi ý nâng cao kỹ năng truy vấn.', 'EXPLAIN ANALYZE SELECT c.id, COUNT(o.id) FROM customers c LEFT JOIN orders o ON c.id = o.customer_id GROUP BY c.id;', '3m 18s'],
];
?>
<div class="breadcrumbs"><span>Dashboard</span><b>›</b><span>Môn học</span><b>›</b><span>Cấu trúc Dữ liệu &amp; SQL Nâng cao</span><b>›</b><span>Chặng 2</span><b>›</b><span>Trạm 2.3</span><b>›</b><strong>Kết quả đánh giá vượt trạm</strong></div>
<section class="mastery-heading">
  <div>
    <span class="pill pill-green">● MASTERED · XUẤT SẮC</span>
    <h1>Chúc Mừng! Bạn Đã Vượt<br class="desktop-break"> Trạm Kiến Thức 2.3 Thành Công</h1>
    <p>Bạn đã làm chủ OUTER JOIN &amp; xử lý giá trị NULL với độ chính xác vượt chuẩn.</p>
  </div>
  <div class="mastery-actions">
    <a class="button button-light" href="chi-tiet-tram.php">↶ Quay lại Roadmap</a>
    <a class="button button-light" href="#question-review">▤ Xem lại 5 câu</a>
    <a class="button button-primary" href="tram-2-4.php">Tiếp tục vào Trạm 2.4 →</a>
  </div>
</section>
<div class="mastery-top-grid">
  <section class="section-card mastery-score-card">
    <div class="result-card-heading"><span class="pill pill-green">✓ PASSED - XUẤT SẮC</span><small>Mã bài thi: MST-2024-QL-0882<br>Thực hiện: 29/10/2024 · 14:32</small></div>
    <div class="mastery-score-content">
      <div class="mastery-gauge-card"><small>UPDATED MASTERY SCORE</small><div class="mastery-gauge"><strong>92</strong><small>/ 100 điểm</small></div><span class="pill pill-green">↗ Tăng +50 điểm từ 42/100</span><small>Vượt ngưỡng chuẩn đầu ra 80 điểm</small></div>
      <div class="mastery-stats">
        <article><span class="metric-icon violet">✓</span><div><small>Độ chính xác bài test</small><strong>5 / 5 câu đúng <em>(100%)</em></strong></div></article>
        <article><span class="metric-icon blue">◷</span><div><small>Thời gian làm bài</small><strong>06 phút 18 giây <em>(+37% thời lượng)</em></strong></div></article>
        <article><span class="metric-icon mint">◈</span><div><small>Mức độ thấu hiểu bản chất</small><strong>Cấp độ 4/5 <em>(Advanced Mastery)</em></strong></div></article>
      </div>
    </div>
    <div class="mastery-note"><strong>Nhận xét AI:</strong> Bạn đã vận dụng chính xác các nguyên tắc JOIN và xử lý NULL trong ngữ cảnh phức tạp. Tiếp tục duy trì cách suy nghĩ “WHERE lọc sau JOIN” và kiểm soát thứ tự ưu tiên của logic TRUE / FALSE / UNKNOWN.</div>
  </section>
  <aside class="section-card mastery-unlock-card">
    <div class="section-heading compact"><div><span class="eyebrow">THÀNH TỰU ĐẠT ĐƯỢC</span><h2>Null Buster &amp; Join Architect</h2></div><span class="pill pill-lavender">Chương 2 · SQL Nâng Cao</span></div>
    <div class="achievement-icon">✦</div><p>Mở khóa huy hiệu chuyên gia xử lý truy vấn bất đối xứng</p>
    <div class="mastery-progress-line"><span>Mức độ hoàn thành kỹ năng Trạm 2.3</span><b>100% (5/5 câu đúng)</b><i><span style="width:100%"></span></i></div>
    <div class="mastery-progress-line green-progress"><span>Độ tin cậy nhận thức (Metacognition Calibration)</span><b>94% (Chuẩn xác)</b><i><span style="width:94%"></span></i></div>
    <div class="experience-box">✧ Điểm thưởng kinh nghiệm Cognita:<br><strong>+350 XP Luyện tập thích ứng <span>+1 Streak Day</span></strong></div>
    <small class="achievement-foot">Chứng thực tự động bởi Cognita Engine v3.2</small>
  </aside>
</div>
<section class="mastery-comparison">
  <div class="section-heading"><div><h2>Chẩn Đoán Đột Phá: Trước và Sau Can Thiệp AI</h2><p class="text-muted">Phân tích sự chuyển biến nhận thức và khắc phục sai lầm cốt lõi của sinh viên Đinh Thị Thùy Trâm</p></div><span class="pill pill-lavender">Evidence-Based Learning Metrics</span></div>
  <div class="comparison-grid">
    <article class="comparison-card baseline-card"><div class="comparison-title"><div><h3>Trước Can Thiệp AI (Baseline)</h3><small>Bài thi chẩn đoán giữa kỳ · 24/10/2024</small></div><span class="pill pill-coral">Điểm: 42/100 (Không đạt)</span></div><div class="comparison-metric"><span>Độ chính xác OUTER JOIN &amp; NULL</span><b>2/5 câu · 40%</b><i><span style="width:40%"></span></i></div><div class="diagnosis-alert"><strong>⚠ Lỗ Hổng Tư Duy Cốt Lõi (Mental Trap):</strong><p>Đồng nhất điều kiện lọc trong <code>ON</code> với điều kiện lọc sau khi JOIN trong <code>WHERE</code>. Khi áp dụng <code>WHERE right_table.col = 'value'</code>, các bản ghi không khớp có giá trị NULL sẽ bị loại bỏ.</p></div><div class="diagnosis-row">Trạng thái nhận thức <b>◉ Tự tin giả tạo (Overconfident Blindspot)</b></div><ul><li>Xử lý tình huống khuyết toàn bộ dữ liệu chưa chính xác.</li><li>Chưa nắm vững quy tắc ba trị của SQL.</li></ul></article>
    <article class="comparison-card mastered-card"><div class="comparison-title"><div><h3>Sau Can Thiệp AI (Mastered)</h3><small>Đánh giá vượt Trạm thông · Hôm nay</small></div><span class="pill pill-green">Điểm: 92/100 (Xuất sắc)</span></div><div class="comparison-metric"><span>Độ chính xác bài test vượt trạm</span><b>5/5 câu đúng · 100%</b><i><span style="width:100%"></span></i></div><div class="diagnosis-success"><strong>✓ Nhận Thức Đã Chuẩn Hóa (Calibrated Mastery):</strong><p>Tách bạch tuyệt đối 2 giai đoạn: bộ lọc đặt trên <code>ON</code> quyết định kết quả ghép dòng; bộ lọc đặt tại <code>WHERE</code> lọc cả bản ghi không tìm thấy. Áp dụng thành thạo <code>COALESCE()</code> và mẫu truy vấn Anti-Join.</p></div><div class="diagnosis-row">Trạng thái nhận thức <b>Chuẩn xác cao (Calibrated Metacognition · 94%)</b></div><ul><li>Xử lý hoàn hảo Three-Valued Logic trong PostgreSQL và MySQL.</li><li>Tự tin giải quyết bài toán bảo toàn dòng dữ liệu không khớp.</li></ul></article>
  </div>
</section>
<section class="mastery-question-section" id="question-review">
  <div class="section-heading"><div><h2>Chi Tiết 5 Câu Hỏi Thích Ứng Vượt Trạm</h2><p class="text-muted">Toàn bộ 5 bài toán chẩn đoán đã được sinh viên giải mã chính xác.</p></div><div class="question-filters"><span>Bộ lọc:</span><button class="active" type="button" data-question-filter="all">Tất cả (5/5 đúng)</button><button type="button" data-question-filter="challenge">Chỉ xem Boss Challenge</button></div></div>
  <div class="mastery-question-list">
  <?php foreach ($questions as $index => $question): ?>
    <article class="mastery-question <?= $index === 4 ? 'boss-question' : '' ?>" data-question-type="<?= $index === 4 ? 'challenge' : 'regular' ?>">
      <?php if ($index === 4): ?><span class="boss-ribbon">● BOSS CHALLENGE · THỬ THÁCH NÂNG CAO</span><?php endif; ?>
      <div class="mastery-question-title"><span class="question-index"><?= $index + 1 ?></span><div><h3><?= $question[0] ?></h3><small>Chủ đề: <?= $question[1] ?></small></div><span class="correct-tag">✓ Chính xác · 100%</span><small class="question-time">◷ <?= $question[4] ?></small></div>
      <p><strong>Nội dung:</strong> <?= $question[2] ?></p><code class="query-sample"><?= $question[3] ?></code>
      <?php if ($index === 4): ?><div class="boss-insight">✦ Lời giải của sinh viên sử dụng phương pháp Pre-Aggregation (Subquery tổng hợp trước), sau đó mới nối bằng LEFT JOIN, tránh tình huống Cartesian Explosion và giảm chi phí truy vấn.</div><?php endif; ?>
    </article>
  <?php endforeach; ?>
  </div>
</section>
<section class="unlock-next-card">
  <div class="unlock-title"><span class="unlock-icon">▣</span><div><span class="eyebrow">LỘ TRÌNH TỰ ĐỘNG CẬP NHẬT</span><h2>Trạm 2.4: Quản Lý Giao Dịch &amp; Khóa ACID ĐÃ ĐƯỢC MỞ KHÓA!</h2></div><div class="unlock-score"><small>CHẶNG 2 · SQL NÂNG CAO</small><strong>Tiến độ chặng: 88%</strong></div></div>
  <div class="unlock-benefits"><article>◷ <strong>Thuật toán Cognita AI</strong><small>Đã ghi nhận hoàn tất toàn diện Trạm 2.3 và xóa bỏ thẻ cảnh báo kiến thức.</small></article><article>↗ <strong>Tiến độ Chặng 2</strong><small>Tăng từ 75% lên 88%. Chỉ còn 1 trạm nữa để hoàn thành toàn bộ chương.</small></article><article>▣ <strong>Rút Ngắn Dự Báo</strong><small>Với điểm số hiện tại, dự kiến hoàn thành Chặng 2 sớm hơn 14/10/2024.</small></article><article>◌ <strong>Lặp Lại Ngắt Quãng</strong><small>Kích hoạt học Spaced Repetition sau 7 ngày để củng cố kiến thức.</small></article></div>
  <div class="unlock-cta"><div><strong>Sẵn Sàng Chinh Phục Kiến Thức Tiếp Theo?</strong><p>Trạm 2.4: Cơ chế Transaction, Savepoint, Deadlock và 4 mức độ cô lập Isolation Level trong Database.</p></div><a class="button button-light" href="tram-2-4.php">Bắt đầu học Trạm 2.4 ngay bây giờ →</a></div>
</section>
<?php include 'includes/lms-footer.php'; ?>
