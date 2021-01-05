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
        $user = fetchUser($pdo, $_SESSION['user']['id']);

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


function getAllPosts($pdo, $allPosts)
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
