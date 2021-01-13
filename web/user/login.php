<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['email'], $_POST['password'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $database = ("SELECT * FROM Users WHERE email = :email");
    $statement = $pdo->prepare($database);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);


    if (password_verify($_POST['password'], $user['password'])) {

        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}


redirect('/index.php');
