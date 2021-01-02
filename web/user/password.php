<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $user = fetchUser($pdo, $_SESSION['user']['id']);

    if (!password_verify($currentPassword, $user['password'])) {
        $_SESSION['CURRENT_PASSWORD_INVALID'][] = "The current password is invalid!";
        redirect('/../settings.php');
        exit;
    }

    if (
        $newPassword !== $confirmPassword ||
        strlen($newPassword) < 8
    ) {
        if (strlen($newPassword) < 8) {
            $_SESSION['PASSWORD_SHORT'][] = "The password must be at least 8 characters";
            redirect('/../settings.php');
            exit;
        } else if ($newPassword !== $confirmPassword) {
            $_SESSION['PASSWORD_NOT_SAME'][] = "The passwords doesn't match!";
            redirect('/../settings.php');
            exit;
        }
    }

    // unset($_SESSION['errors']);

    $hash = password_hash($newPassword, PASSWORD_DEFAULT);

    $statement = $pdo->prepare('UPDATE Users SET password = ? WHERE id = ?');

    $statement->execute([$hash, $_SESSION['user']['id']]);
    $_SESSION['PASSWORD_SUCCESS'][] = "Password is updated!";

    redirect('/../settings.php');
}
