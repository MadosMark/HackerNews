<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<div class="signup_container">
    <h2 class="signup_title">Sign Up</h2>
    <p class="fill_out_form">Fill out this form to register an account.</p>

    <form action="web/user/register.php" method="post">
        <div class="signup_form">
            <label for="username"> Username: </label> <span class="username-error"> </span>
            <input type="text" name="username" id="username" class="form-validate" placeholder="Enter username" required>
            <label for="first_name"> First name: </label>
            <input type="text" name="first_name" id="first_name" placeholder="Enter first name" required>
            <label for="last_name"> Last name: </label>
            <input type="text" name="last_name" id="last_name" placeholder="Enter last name" required>
            <label for="email"> Email: </label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <label for="password"> Password: </label> <span class="password-error"></span>
            <input type="password" name="createPassword" id="createPassword" class="form-validate" placeholder="Enter password" required>
            <label for="pwdrepeat"> Repeat password: </label>
            <input type="password" name="pwdrepeat" id="pwdrepeat" placeholder="Repeat password" required>
            <button type="submit" name="submit" class="signup_button"> Create account </button>
        </div>
        <div class="already_have_account">
            <p> Already have an account? </p>
            <a href="loginPage.php">Log In here!</a>
        </div>
    </form>

</div>
<?php require __DIR__ . '/homepage/footer.php'; ?>