<?php if (isset($_SESSION['error'])) : ?>
    <p><?php echo $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?></p>
<?php endif; ?>


<?php if (isset($_SESSION['success'])) : ?>
    <p><?php echo $_SESSION['success']; ?>
        <?php unset($_SESSION['success']); ?></p>
<?php endif; ?>
