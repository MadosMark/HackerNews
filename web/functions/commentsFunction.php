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

function updateComment($pdo, $comment, $postId, $commentId)
{
    $database = "UPDATE Comments SET comment = :comment WHERE post_id = :postId AND id = :commentId";
    $statement = $pdo->prepare($database);
    $statement->bindParam(':comment', $comment);
    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':commentId', $commentId);

    $statement->execute();
}


function deleteComment($pdo, $id)
{
    $statement = $pdo->prepare('DELETE FROM Comments WHERE id = :id OR related_id = :id OR parent_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}


function fetchCommentReplies($pdo, $postId, $commentId)
{
    $comments = fetchPostsComments($pdo, $postId);

    $commentReplies = [];
    foreach ($comments as $comment) {
        if ($comment['parent_id'] === $commentId) {

            $commentReplies[] = $comment;
        }
    }
    return $commentReplies;
}
