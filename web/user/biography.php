<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['biography'])) {
    $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('UPDATE Users SET biography = ? WHERE id = ?');

    $statement->execute([$biography, $_SESSION['user']['id']]);
    $_SESSION['BIO_SUCCESS'][] = "Your biography is updated!";

    redirect('/../settings.php');
}
