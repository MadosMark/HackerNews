<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php $user = confirmUser($pdo); ?>

<?php if (!isset($_SESSION['user'])) : ?>
    <p> You need to be logged in to submit posts! </p>
<?php endif; ?>

<?php if (isset($_SESSION['user'])) : ?>
    <form action="/web/post/store.php" method="post">
        <div class="create_post_container">
            <label for="title"> Title </label>
            <input type="text" name="title" id="title" placeholder="Enter title" required>
            <label for="description"> Description </label>
            <input type="text" name="description" id="description" placeholder="Enter text" required>
            <label for="url"> Url to the post </label>
            <input type="url" name="url" id="url" placeholder=" Enter url" required>
            <button type="submit" class="create_post_button"> Create post </button>
        </div>
    </form>
<?php endif; ?>

<?php require __DIR__ . '/homepage/footer.php'; ?>