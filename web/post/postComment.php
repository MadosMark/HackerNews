<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';


if (isset($_POST['comment'], $_POST['post_id'])) {
    $comment = $_POST['comment'];

    $userId = $_SESSION['user']['id'];
    $commentDate = date("Y-m-d D h:i");
    $postId = $_POST['post_id'];

    $_SESSION['successful'] = [];
    $_SESSION['errors'] = [];

    $database = "INSERT INTO Comments (comment, comment_date, user_id, post_id) VALUES (:comment, :commentDate, :userId, :postId);";
    $statement = $pdo->prepare($database);

    $statement->BindParam(':comment', $comment);
    $statement->BindParam(':commentDate', $commentDate);
    $statement->BindParam(':userId', $userId);
    $statement->BindParam(':postId', $postId);

    $statement->execute();




    redirect("/../comments.php?id=$postId");
}
