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
    $statement = $pdo->query('SELECT COUNT(Likes.post_id) AS votes, Posts.*, Users.username FROM Likes
    INNER JOIN Posts
    ON Posts.id = Likes.post_id
    INNER JOIN Users 
    ON Posts.user_id = Users.id
    GROUP BY 
    Posts.id
    ORDER BY COUNT(1) DESC
    LIMIT 15; 
   ');

    $statement->execute();

    $popularVotes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $popularVotes;
}
