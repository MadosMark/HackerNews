<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<div class="login_container">
    <h1 class="login_title"> Log In</h1>
    <form action="/web/user/login.php" method="post">
        <div class="login_form">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <button type="submit" class="login_button">Log in</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/homepage/footer.php'; ?>