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
