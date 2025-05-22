<script src="https://kit.fontawesome.com/03deb1591a.js" crossorigin="anonymous"></script>
<script src="../public/js/navbar.js"></script>
<script src="../public/js/modail.js"></script>
<script src="../public/js/autologout.js"></script>
<?php echo $data['script'] ?? ''; ?>

<script> <?php echo $data['redirect'] ?? '';?></script>
<?php if (isset($data['message'])){?>
            <script>
                alert("<?php echo $data['message'] ?? '';?>");
            </script>
<?php } ?>
</body>
</html>