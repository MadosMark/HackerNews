<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    $user = fetchUser($pdo, $_SESSION['user']['id']);

    $avatar = $_FILES['avatar'];
    $userId = $user['id'];
    $username = $user['username'];
    $currentAvatar = $user['avatar'];

    $newFileName = $avatar['name'];
    $newFileNameArray = explode('.', $newFileName);
    $newFileEnd = array_pop($newFileNameArray);

    if ($currentAvatar === null) {
        $newAvatar = "$username-$userId.$newFileEnd";
    } else {
        $currentAvatarArray = explode('.', $currentAvatar);
        $avatarId = $currentAvatarArray[0];
        $newAvatar = "$avatarId.$newFileEnd";
    }

    if ($avatar['type'] !== 'image/png' && $avatar['type'] !== 'image/jpeg') {
        $_SESSION['avatarInvalidType'][] = "The filetype must be a .jpg, .jpeg or .png.";
        redirect('/../settings.php');
        exit;
    }

    if ($avatar['size'] >= 3145728) {
        $_SESSION['avatarTooBig'][] = "The image is too big!";
        redirect('/../settings.php');
        exit;
    }

    move_uploaded_file($avatar['tmp_name'], __DIR__ . "/../../uploads/avatars/$newAvatar");

    $statement = $pdo->prepare('UPDATE Users SET avatar = ? WHERE id = ?');

    $statement->execute([$newAvatar, $userId]);
    redirect('/../settings.php');
}
