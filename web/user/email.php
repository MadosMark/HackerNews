<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['email'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('/../settings.php');
        exit;
    }

    $statement = $pdo->prepare('SELECT email FROM Users WHERE email = ?');
    $emailExists = checkIfExists($statement, $email);

    if ($emailExists) {
        $_SESSION['emailExist'][] = "Email already exists!";
        redirect('/../settings.php');
        exit;
    }

    $statement = $pdo->prepare('UPDATE Users SET email = ? WHERE id = ?');
    $statement->execute([$email, $_SESSION['user']['id']]);
    $_SESSION['successful'][] = "Updated email!";

    redirect('/../settings.php');
}
