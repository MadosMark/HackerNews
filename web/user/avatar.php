<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {

    $user = fetchUser($pdo, $_SESSION['user']['username']);
    $avatar = $_FILES['avatar'];
    $userId = $user['id'];
    $file_tmp = $_FILES['avatar']['tmp_name'];
    $currentAvatar = $user['avatar'];
    $newFileName = $avatar['name'];
    $newFileNameArray = explode('.', $newFileName);
    $file_extention = end($newFileNameArray);
    $file_name_new = "profile_picture" . $userId . '.' . $file_extention;
    $file_destination = __DIR__ . '/../../uploads/avatars/' . $file_name_new;

    if ($avatar['size'] >= 3145728) {
        $_SESSION['avatarTooBig'][] = "The image is too big!";
        redirect('/../settings.php');
        exit;
    }

    move_uploaded_file($file_tmp, $file_destination);
    $statement = $pdo->prepare('UPDATE Users SET avatar = :imagePath WHERE id = :id');
    $statement->bindParam(':id', $userId);
    $statement->bindParam(':imagePath', $file_name_new);
    $statement->execute();
    redirect('/../settings.php');
}
