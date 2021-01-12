<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['post-id'])) {


    $userId = $_SESSION['user']['id'];

    $postId = $_POST['post-id'];

    $_SESSION['errors'] = [];

    $upvoteByUser = upvoteByUser($pdo, $postId, $userId);

    if (!is_array($upvoteByUser)) {

        $statement = $pdo->prepare("INSERT INTO Likes (post_id, user_id) VALUES (:postId, :userId);");


        $statement->BindParam(':postId', $postId);
        $statement->BindParam(':userId', $userId);


        $statement->execute();



        redirect("/index");
    } else {

        $statement = $pdo->prepare("DELETE FROM Likes WHERE post_id = :postId AND user_id = :userId;");

        $statement->BindParam(':postId', $postId);
        $statement->BindParam(':userId', $userId);


        $statement->execute();
        redirect("/index");
    }
}
