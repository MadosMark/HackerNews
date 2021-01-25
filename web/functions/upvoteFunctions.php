<?php

declare(strict_types=1);

function countUpvotes($pdo, $postId)
{
    $database = ('SELECT COUNT(*) FROM Likes WHERE post_id = :postId');
    $statement = $pdo->prepare($database);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvotes['COUNT(*)'];
}

function upvoteUser($pdo, $postId, $userId)
{
    $database = ('SELECT * FROM Likes WHERE post_id = :postId AND user_id = :userId;');
    $statement = $pdo->prepare($database);

    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();

    $upvoteUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvoteUser;
}

function popularUpvotes($pdo)
{
    $database = ('SELECT COUNT(Likes.post_id) AS votes, Posts.*, Users.username FROM Likes
    INNER JOIN Posts
    ON Posts.id = Likes.post_id
    INNER JOIN Users
    ON Posts.user_id = Users.id
    GROUP BY
    Posts.id');


    $statement = $pdo->prepare($database);
    $statement->execute();

    $popularVotes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $popularVotes;
}

//Upvote functions for comments
function userHasUpvoteComment(PDO $pdo, int $commentId, int $userId): bool
{
    $database = ('SELECT * FROM Likes_on_comments WHERE comment_id = :commentId AND user_id = :userId;');
    $statement = $pdo->prepare($database);

    $statement->bindParam(':commentId', $commentId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();
    $upvoteFromUserExist = $statement->fetch(PDO::FETCH_ASSOC);

    if ($upvoteFromUserExist) {
        return true;
    } else {
        return false;
    }
}

function countUpvotesOnComment(PDO $pdo, int $commentId): string
{
    $database = ('SELECT COUNT(*) FROM Likes_on_comments WHERE comment_id = :commentId');
    $statement = $pdo->prepare($database);
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvotes['COUNT(*)'];
}

function deleteCommentLikes(PDO $pdo, int $id): void
{
    $statement = $pdo->prepare('SELECT * FROM Comments WHERE id = :id OR related_id = :id OR parent_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($comments as $comment) {
        $commentId = $comment['id'];

        $statement = $pdo->prepare('DELETE FROM Likes_on_comments WHERE comment_id = :commentId');
        $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $statement->execute();
    }
}
