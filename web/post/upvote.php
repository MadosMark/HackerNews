<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['id'])) {

    $userId = $_SESSION['user']['id'];
    $postId = $_POST['id'];

    $upvoteUser = upvoteUser($pdo, $postId, $userId);

    if (!is_array($upvoteUser)) {

        $database = ("INSERT INTO Likes (post_id, user_id) VALUES (:postId, :userId);");
        $statement = $pdo->prepare($database);

        $statement->BindParam(':postId', $postId);
        $statement->BindParam(':userId', $userId);

        $statement->execute();

        redirect('../../index.php');
    } else {

        $database = ("DELETE FROM Likes WHERE post_id = :postId AND user_id = :userId;");
        $statement = $pdo->prepare($database);

        $statement->BindParam(':postId', $postId);
        $statement->BindParam(':userId', $userId);

        $statement->execute();
        redirect('../../index.php');
    }
}
