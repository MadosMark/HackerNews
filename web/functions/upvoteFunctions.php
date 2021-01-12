<?php

declare(strict_types=1);

function countUpvotes($pdo, $postId)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM Likes WHERE post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvotes['COUNT(*)'];
}

function upvoteUser($pdo, $postId, $userId)
{
    $statement = $pdo->prepare('SELECT * FROM Likes WHERE post_id = :postId AND user_id = :userId;');

    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();

    $upvoteUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvoteUser;
}

function popularUpvotes($pdo)
{
    $statement = $pdo->query('SELECT Posts.*, Likes.post_id FROM Posts INNER JOIN Likes ON Posts.id = Likes.post_id ORDER BY Posts.id');

    $statement->execute();

    $popularUpvotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $popularUpvotes;
}
