<?php require __DIR__ . '/web/autoload.php'; ?>
<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>


<div class="newsContainer">

    <article>
        <h1><?php echo $config['title']; ?></h1>
        <p> Home Page </p>

        <?php if (isset($_SESSION['user'])) : ?>
            <p> Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</p>
        <?php endif; ?>
    </article>

</div>



<?php require __DIR__ . '/homepage/footer.php'; ?>