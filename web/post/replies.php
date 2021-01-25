<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';


if (isset($_POST['comment'], $_POST['post_id'], $_POST['comment_id'], $_POST['related_id'])) {

    $userId = $_SESSION['user']['id'];
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $commentDate = date("Y-m-d D h:i");
    $commentId = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $parentId = $commentId;
    $relatedId = filter_var($_POST['related_id'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($comment)) {
        $_SESSION['error'] = "Comment text field cannot be empty.";
        redirect("/comments.php?id=$postId");
    }

    $query = "INSERT INTO Comments (comment, comment_date, user_id, post_id, parent_id, related_id) VALUES (:comment, :commentDate, :userId, :postId, :parentId, :relatedId);";

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->BindParam(':comment', $comment);
    $statement->BindParam(':commentDate', $commentDate);
    $statement->BindParam(':userId', $userId);
    $statement->BindParam(':postId', $postId);
    $statement->BindParam(':parentId', $parentId);
    $statement->BindParam(':relatedId', $relatedId);
    $statement->execute();

    $_SESSION['success'] = "Your reply has been submitted.";
}


redirect("/comments.php?id=$postId");
