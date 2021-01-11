<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function errorMsg()
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo $error;
        }
    }
}



function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usernameExists($pdo, $username)
{

    $statement = $pdo->prepare('SELECT * FROM Users WHERE username = :username;');
    $statement->BindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    // check if user exists 
    $checkUser = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['checkuser'] = $checkUser;

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
}

/* check database for existing email */
function emailExists($pdo, $email)
{

    $statement = $pdo->prepare('SELECT * FROM Users WHERE email = :email;');
    $statement->BindParam(':email', $email);
    $statement->execute();

    // check if user exists 
    $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['checkEmail'] = $checkEmail;
}

function createUser($pdo, $username, $first_name, $last_name, $email, $password, $message)
{
    $_SESSION['successful'] = [];

    $sql = "INSERT INTO Users (username, first_name, last_name, email, password) VALUES (:username, :first_name, :last_name, :email, :password);";
    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $statement->BindParam(':username', $username);
    $statement->BindParam(':first_name', $first_name);
    $statement->BindParam(':last_name', $last_name);
    $statement->BindParam(':email', $email);
    $statement->BindParam(':password', $hashedPwd);

    $statement->execute();

    $_SESSION['successful'][] = "Your account has been created! You can now log in.";
    /* $_SESSION['successful'] = $message;
 
    echo $message; */
    redirect("/index.php");
}

function confirmUser($pdo)
{
    if (isset($_SESSION['user']['id'])) {
        $user = fetchUser($pdo, $_SESSION['user']['username']);

        return $user;
    } else {
        redirect('/loginPage.php');
    }
}

function fetchUser($pdo, $username)
{
    $statement = $pdo->prepare("SELECT id, username, avatar, biography FROM Users WHERE username = :username");
    $statement->BindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $userProfile =  $statement->fetch(PDO::FETCH_ASSOC);

    return $userProfile;
}

function fetchUserByUsername($pdo, $username)
{
    $statement = $pdo->prepare('SELECT id, first_name, last_name, avatar, biography, username
    FROM Users WHERE username = ?');

    $statement->execute([$username]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function checkIfExists(PDOStatement $statement, string $userInput)
{
    $statement->execute([$userInput]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function errorMessage()
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo $error;
        }
    }
}

function getUserPosts($pdo, int $profileId)
{
    $_SESSION['errors'] = [];

    $statement = $pdo->prepare("SELECT Posts.id, title, description, post_url, post_date, user_id FROM Posts
    INNER JOIN Users
    ON Posts.user_id = Users.id
    WHERE Users.id = :id
    ORDER BY Posts.id DESC");

    $statement->BindParam(':id', $profileId, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$userPosts) {
        return $_SESSION['errors'][] = "No posts yet.";
    }

    return $userPosts;
}

function getAllPosts($pdo)
{

    $_SESSION['errors'] = [];

    $statement = $pdo->prepare("SELECT * FROM Posts
    ORDER BY Posts.post_date DESC");

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$allPosts) {
        return  $_SESSION['errors'][] = "Ops, could not find posts";
    }

    return $allPosts;
}

function getPostsComments($pdo, $postId)
{
    $_SESSION['errors'] = [];

    $statement = $pdo->prepare("SELECT Comments.*, Users.username FROM Comments 
    INNER JOIN Users 
    ON Comments.user_id = Users.id
    WHERE post_id = :postId
    ORDER BY Comments.post_id DESC");

    $statement->BindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $userComments = $statement->fetchAll(PDO::FETCH_ASSOC);



    if (!$userComments) {
        return $_SESSION['errors'][] = "No comments yet.";
    } else {


        return $userComments;
    }
}

function countComments($pdo, $postId)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM Comments WHERE post_id = :postId');

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $comments = $statement->fetch(PDO::FETCH_ASSOC);

    return $comments['COUNT(*)'];
}

function getPostbyId($pdo, $postId)
{
    $_SESSION['errors'] = [];

    $statement = $pdo->prepare("SELECT * FROM Posts WHERE id = :postId");
    $statement->bindParam(':postId', $postId);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        return  $_SESSION['errors'][] = "Ops, could not find any post";
    }

    return $post;
}

function countLikes($pdo, $postId)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM Likes WHERE post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return $likes['COUNT(*)'];
}

function isLikedByUser($pdo, $postId, $userId)
{

    $statement = $pdo->prepare('SELECT * FROM Likes WHERE post_id = :postId
    AND user_id = :userId;');

    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();

    $isLikedByUser = $statement->fetch(PDO::FETCH_ASSOC);

    return $isLikedByUser;
}

function updateComment($pdo, int $postId, int $userId, int $commentId, string $comment)
{

    $sql = "UPDATE Comments SET comment = :comment WHERE comment_id = :commentId AND post_id = :postId AND user_id = :userId;";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':comment', $comment);
    $statement->bindParam(':commentId', $commentId);
    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();
}

function updatePost($pdo, int $postId, int $userId, string $title, string $description, string $url)
{

    $sql = "UPDATE Posts SET title = :title,
    description = :description, 
    post_url = :url
    WHERE id = :postId AND user_id = :userId;";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':url', $url);
    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);

    $statement->execute();
}


function deleteComment($pdo, int $postId, int $userId, int $commentId)
{

    $statement = $pdo->prepare("DELETE FROM Comments WHERE post_id = :postId AND comment_id = :commentId AND user_id = :userId;");

    $statement->BindParam(':postId', $postId);
    $statement->bindParam(':commentId', $commentId);
    $statement->BindParam(':userId', $userId);



    $statement->execute();
}


function deletePost($pdo, int $postId, int $userId)
{
    $statement = $pdo->prepare("DELETE FROM Posts WHERE id = :postId AND user_id = :userId;
    DELETE FROM Comments WHERE post_id = :postId;
    DELETE FROM Likes WHERE post_id = :postId; 
    ");

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);


    $statement->execute();
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
}

function uploadImage($pdo, $avatar, $id)
{
    $statement = $pdo->prepare("UPDATE Users SET avatar = :avatar WHERE id = :id");
    $statement->BindParam(':avatar', $avatar['name'], PDO::PARAM_STR);
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}
