<script src="https://kit.fontawesome.com/03deb1591a.js" crossorigin="anonymous"></script>
<script src="../public/js/navbar.js"></script>
<script src="../public/js/modail.js"></script>
<script src="../public/js/autologout.js"></script>
<?php echo $data['script'] ?? ''; ?>

<script> <?php echo $data['redirect'] ?? '';?></script>
<?php if (isset($data['message'])){?>
            <div id="modail-message" class="modail">
            <i class="fa-solid fa-x" id="removebtn"></i>
            <div class="modail-content">
                <?php echo $data['message'] ?? '';?>
            </div>
            </div>
<?php } ?>
</body>
</html>