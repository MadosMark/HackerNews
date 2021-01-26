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


///Upvotes on comments
if (isset($_POST['comment_id'], $_POST['post_id'])) {

    $userId = $_SESSION['user']['id'];
    $commentId = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $userUpvoteExist = userHasUpvoteComment($pdo, (int)$commentId, (int)$userId);

    if ($userUpvoteExist) {
        $database = ("DELETE FROM Likes_on_comments WHERE comment_id = :commentId AND user_id = :userId;");
        $statement = $pdo->prepare($database);

        $statement->BindParam(':commentId', $commentId);
        $statement->BindParam(':userId', $userId);

        $statement->execute();

        redirect('../../comments.php?id=' . $postId);
    } else {
        $database = ("INSERT INTO Likes_on_comments (comment_id, user_id) VALUES (:commentId, :userId);");
        $statement = $pdo->prepare($database);

        $statement->BindParam(':commentId', $commentId);
        $statement->BindParam(':userId', $userId);

        $statement->execute();

        redirect('../../comments.php?id=' . $postId);
    }
}
