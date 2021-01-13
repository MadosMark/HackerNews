<?php

declare(strict_types=1);

function getUserPosts($pdo, $profileId)
{



    $statement = $pdo->prepare("SELECT Posts.id, title, description, post_url, post_date, user_id FROM Posts
INNER JOIN Users
ON Posts.user_id = Users.id
WHERE Users.id = :id
ORDER BY Posts.id DESC");


    $statement->BindParam(':id', $profileId, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);



    return $userPosts;
}

function fetchAllPosts($pdo)
{

    $statement = $pdo->prepare("SELECT * FROM Posts ORDER BY Posts.post_date DESC");

    $statement->execute();

    $fetchPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $fetchPosts;
}

function fetchPostbyId($pdo, $postId)
{

    $statement = $pdo->prepare("SELECT * FROM Posts WHERE id = :postId");
    $statement->bindParam(':postId', $postId);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    return $post;
}

function updatePost($pdo, $id, $title, $description, $url, $userId)
{

    $database = "UPDATE Posts
    SET
    title = :title,
    description = :description, 
    post_url = :url
    WHERE id = :id
    AND user_id = :userId;";

    $statement = $pdo->prepare($database);

    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':url', $url);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':userId', $userId);

    $statement->execute();
}

function deletePost($pdo, $id, $userId)
{
    $database = "DELETE FROM Posts 
    WHERE id = :id AND user_id = :userId;
    DELETE FROM Comments WHERE post_id = :id;
    DELETE FROM Likes WHERE post_id = :id; 
    ";

    $statement = $pdo->prepare($database);

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);

    $statement->execute();
}
