<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $last_name = filter_Var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['createPassword'];
    $password_repeat = $_POST['pwdrepeat'];

    createUser($pdo, $username, $first_name, $last_name, $email, $password, $message);



    $_SESSION['errors'] = [];

    usernameExists($pdo, $username);
    if ($_SESSION['checkuser']['username'] === $username) {

        $_SESSION['errors'][] = "The username is already taken, please try again!";
        redirect("../signUp.php");
    }

    emailExists($pdo, $email);
    if ($_SESSION['checkEmail'] === $email) {
        $_SESSION['errors'][] = "Email already registered!";
        redirect("../signUp.php");
    }

    if (invalidEmail($email) !== false) {
        $_SESSION['errors'][] = "The email is invalid, please try again!";
        redirect("../signUp.php");
        exit();
    }

    if ($password !== $password_repeat) {
        $_SESSION['errors'][] = "Passwords did not match";

        redirect("../signUp.php");
    }
};
