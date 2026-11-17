<?php
$page_title = 'Tài liệu học tập - Cognita AI LMS';
$active_page = 'tai-lieu';
$body_class = 'documents-page';
include 'includes/lms-header.php';
?>
<div class="breadcrumbs"><span>Góc sinh viên</span><b>›</b><strong>Tài liệu học tập</strong></div>
<div class="documents-title-row"><div><h1>Quản Lý &amp; Phân Tích Tài Liệu Học Tập</h1><p>Tải lên tài liệu giáo trình để AI đọc hiểu, trích xuất tóm tắt kiến thức và chuẩn bị câu hỏi ôn tập thích ứng.</p></div><span class="pill pill-green">● Mô hình học máy sẵn sàng</span></div>
<section class="section-card upload-status-legend"><span>☷</span><small>Trạng thái mẫu (Demo):</small><span class="document-state selected">A. Chưa chọn tệp</span><span class="document-state">B. Đã chọn tệp</span><span class="document-state">C. Đang tải lên 68%</span><span class="document-state">D. AI đang xử lý</span><span class="document-state">E. Phân tích xong</span><span class="document-state">F. Báo lỗi tệp</span></section>
<section class="section-card upload-card">
  <div class="upload-heading"><span class="upload-heading-icon">♧</span><div><h2>Tải lên tài liệu học tập</h2><p>Chọn hoặc kéo thả tài liệu bạn muốn ôn luyện. AI sẽ đọc nội dung để tạo bản tóm tắt tri thức và ngân hàng câu hỏi.</p></div><span class="upload-limit">ⓘ Hỗ trợ: PDF, DOCX, PPTX, TXT (tối đa 20 MB)</span></div>
  <form id="document-upload-form" novalidate>
    <input id="document-file" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" hidden>
    <div class="upload-dropzone" id="upload-dropzone" tabindex="0" role="button" aria-label="Chọn hoặc thả tệp tài liệu">
      <div class="drop-file-icon">⇧</div><strong>Kéo và thả tài liệu vào đây</strong><span>hoặc nhấn vào nút phía dưới để tìm tài liệu từ thiết bị</span><button class="button button-primary" type="button" id="choose-document">▱ Chọn tài liệu từ máy</button>
      <div class="supported-file-types"><span class="file-type pdf">▣</span> PDF <span class="file-type doc">▣</span> DOCX <span class="file-type ppt">▣</span> PPTX <span class="file-type txt">▤</span> TXT <b>•</b> Dung lượng tối đa: 20 MB</div>
      <div class="selected-file" id="selected-file" hidden></div>
    </div>
    <div class="upload-form-section">
      <div class="form-section-heading"><span>☷</span><div><h3>Thông tin bổ sung về tài liệu</h3></div></div>
      <div class="document-fields"><label>Tên tài liệu học tập <b>*</b><input id="document-title" type="text" value="Kiến trúc CSDL Phân tán &amp; Chuẩn hóa 3NF" required><small>Đặt tên gợi nhớ để phân loại trong kho kiến thức cá nhân</small></label><label>Môn học tương ứng <b>*</b><select id="document-course" required><option value="Cơ sở dữ liệu">Cơ sở dữ liệu</option><option value="Cấu trúc dữ liệu & SQL nâng cao">Cấu trúc dữ liệu &amp; SQL nâng cao</option><option value="Software Testing">Software Testing</option><option value="Trí tuệ nhân tạo">Trí tuệ nhân tạo</option></select><small>Phục vụ việc tự động xếp vào lộ trình học tập của bạn</small></label></div>
      <label class="document-description">Mục tiêu học tập của bạn <span>(Không bắt buộc)</span><textarea id="document-goal" placeholder="Bạn muốn đạt được điều gì sau khi học tài liệu này? (Ví dụ: Nắm vững chuẩn hóa dữ liệu 3NF và BCNF để làm bài kiểm tra giữa kỳ)">Bạn muốn đạt được điều gì sau khi học tài liệu này? (Ví dụ: Nắm vững chuẩn hóa dữ liệu 3NF và BCNF để làm bài kiểm tra giữa kỳ)</textarea></label>
    </div>
    <div class="upload-form-section ai-options-section">
      <div class="form-section-heading"><span>☷</span><div><h3>Tùy chọn AI hỗ trợ sau khi tải lên</h3><p>Chọn các tác vụ bạn muốn hệ thống AI thực hiện tự động</p></div><span class="pill pill-lavender">Tối ưu hóa học tập cá nhân</span></div>
      <div class="ai-option-grid"><label class="ai-option"><input type="checkbox" checked><span class="ai-option-icon">▤</span><span><strong>Tạo tóm tắt tài liệu</strong><small>AI trích xuất bản tóm tắt các nội dung quan trọng và danh sách ý chính theo chương mục.</small></span></label><label class="ai-option"><input type="checkbox" checked><span class="ai-option-icon">▣</span><span><strong>Tạo câu hỏi kiểm tra</strong><small>AI xây dựng bộ câu hỏi trắc nghiệm &amp; tình huống thực tế bám sát tài liệu vừa tải lên.</small></span></label><label class="ai-option"><input type="checkbox" checked><span class="ai-option-icon">⌘</span><span><strong>Phân tích cây kiến thức</strong><small>Xác định chủ đề trọng tâm, mức độ khó và liên kết nội dung vào cây tri thức của bạn.</small></span></label></div>
    </div>
    <div class="upload-footer"><span>♢ Tài liệu được bảo vệ an toàn trong không gian học tập của bạn</span><div><button class="button button-light" type="reset">Đặt lại</button><button class="button button-primary" type="submit">Bắt đầu phân tích bằng AI →</button></div></div>
    <div class="upload-feedback" id="upload-feedback" role="status" hidden></div>
  </form>
</section>
<section class="recent-documents"><div class="section-heading"><h2>Tài liệu học tập gần đây <span class="pill pill-lavender">3 tài liệu</span></h2><a href="#recent-documents">Xem toàn bộ kho tài liệu ›</a></div>
  <div class="document-card-grid" id="recent-documents">
    <article class="document-card"><div class="document-card-top"><span class="document-file-icon pdf">▣</span><span class="document-status ready">● Đã phân tích</span></div><h3>Cơ sở dữ liệu nâng cao.pdf</h3><div class="document-meta"><span>Cơ sở dữ liệu</span><small>2.4 MB</small></div><small class="document-date">▢ Tải lên: 08/10/2026</small><div class="document-card-actions"><button type="button" class="button button-light button-small" data-document-action="Tóm tắt">Xem tóm tắt</button><button type="button" class="button button-primary button-small" data-document-action="Luyện Quiz">▣ Luyện Quiz</button></div></article>
    <article class="document-card"><div class="document-card-top"><span class="document-file-icon doc">▤</span><span class="document-status processing">◷ Đang xử lý</span></div><h3>Software Testing.pdf</h3><div class="document-meta"><span>Công nghệ phần mềm</span><small>1.8 MB</small></div><small class="document-date">▢ Tải lên: 06/10/2026</small><div class="document-card-actions"><button type="button" class="button button-light button-small" data-document-action="Trạng thái xử lý">⟳ Xem tiến độ xử lý</button></div></article>
    <article class="document-card"><div class="document-card-top"><span class="document-file-icon ppt">▣</span><span class="document-status pending">● Chưa phân tích</span></div><h3>Machine Learning Basics.pdf</h3><div class="document-meta"><span>Trí tuệ nhân tạo</span><small>3.2 MB</small></div><small class="document-date">▢ Tải lên: 04/10/2026</small><div class="document-card-actions"><button type="button" class="button button-outline button-small" data-document-action="Phân tích">▶ Bắt đầu phân tích</button></div></article>
  </div>
</section>
<?php include 'includes/lms-footer.php'; ?>
