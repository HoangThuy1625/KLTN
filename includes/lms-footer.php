  </main>
</div>
<footer class="site-footer">
  <a href="<?= !empty($is_admin) ? 'quan-tri.php' : 'lo-trinh.php' ?>" aria-label="Về trang chính Cognita AI LMS">Cognita AI LMS</a>
  <span>Hệ thống học tập cá nhân hóa &amp; Phân tích Trí tuệ Nhân tạo</span>
  <span>Trang Trợ giúp</span><span>Chính sách quyền riêng tư AI</span><span>© 2026 Cognita</span>
</footer>
<script>window.CognitaAuthMode = <?= json_encode(cognita_is_mock_auth() ? 'mock' : 'backend') ?>;</script>
<script src="js/i18n.js"></script>
<script src="js/mock-auth.js"></script>
<script src="js/lms.js"></script>
</body>
</html>
