<?php require __DIR__ . '/web/autoload.php'; ?>
<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<section>
    <h1> Log In</h1>

    <form action="/web/user/login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Enter email here" required>

        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Enter password here" required>

        </div>

        <button type="submit" class="btn btn-primary">Log in</button>
    </form>


</section>

<?php require __DIR__ . '/homepage/footer.php'; ?>