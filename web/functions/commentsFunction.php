<?php

declare(strict_types=1);

function fetchPostsComments($pdo, $postId)
{
    $_SESSION['errors'] = [];

    $statement = $pdo->prepare("SELECT Comments.*, Users.username 
    FROM Comments
    INNER JOIN Users
    ON Comments.user_id = Users.id
    WHERE post_id = :postId
    ORDER BY Comments.post_id DESC");

    $statement->BindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $userComments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $userComments;
}

function countComments($pdo, $postId)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM Comments WHERE post_id = :postId');

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $comments = $statement->fetch(PDO::FETCH_ASSOC);

    return $comments['COUNT(*)'];
}

function updateComment($pdo, $comment, $commentId, $userId, $postId)
{

    $database = "UPDATE Comments SET comment = :comment WHERE comment_id = :commentId AND post_id = :postId AND user_id = :userId;";
    $statement = $pdo->prepare($database);
    $statement->bindParam(':comment', $comment);
    $statement->bindParam(':commentId', $commentId);
    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();
}

function deleteComment($pdo, $userid)
{
    $statement = $pdo->prepare('DELETE FROM Comments WHERE post_id = :userid');
    $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
    $statement->execute();
}
