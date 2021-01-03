<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>
<?php require __DIR__ . '/homepage/signUpHeader.php'; ?>

<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill out this form to create an account.</p>

    <form action="web/user/register.php" method="post">
        <div class="form-group">
            <label for="username"> Username: </label> <span class="username-error"> </span>
            <input type="text" name="username" id="username" class="form-validate" placeholder="Username..." required>
            <span class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="first_name"> First name: </label>
            <input type="text" name="first_name" id="first_name" placeholder="First name..." required>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label for="last_name"> Last name: </label>
            <input type="text" name="last_name" id="last_name" placeholder="Last name..." required>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label for="email"> Email: </label>
            <input type="email" name="email" id="email" placeholder="Email..." required>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label for="password"> Password: </label> <span class="password-error"></span>
            <input type="password" name="createPassword" id="createPassword" class="form-validate" placeholder="Password..." required>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label for="pwdrepeat"> Repeat password: </label>
            <input type="password" name="pwdrepeat" id="pwdrepeat" placeholder="Repeat password..." required>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary"> Create account </button>
        </div>

        <p>Already have an account? <a href="loginPage.php">Log In here!</a></p>
    </form>
</div>

<!-- <div class="error_container">
            <?php if (isset($_SESSION['errors'])) {  ?>
                <p class="error-msg">
                <?php errorMsg();
                unset($_SESSION['errors']);
            } ?>
                </p>
        </div> -->

<?php require __DIR__ . '/homepage/footer.php'; ?>