<script src="https://kit.fontawesome.com/03deb1591a.js" crossorigin="anonymous"></script>
<script src="../public/js/navbar.js"></script>
<script src="../public/js/autologout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $data['script'] ?? ''; ?>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['flash_message'])) {
    $data['message'] = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>
<?php if (isset($data['message'])){?>
    <!-- Bootstrap Modal voor meldingen -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="messageModalLabel">Melding</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo htmlspecialchars($data['message'] ?? ''); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();
      });
    </script>
<?php } ?>
</body>
</html>