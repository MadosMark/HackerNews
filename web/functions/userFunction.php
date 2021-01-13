<?php

declare(strict_types=1);


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

    $checkUser = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['checkuser'] = $checkUser;

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
}


function emailExists($pdo, $email)
{
    $_SESSION['successful'] = [];

    $statement = $pdo->prepare('SELECT * FROM Users WHERE email = :email;');
    $statement->BindParam(':email', $email);
    $statement->execute();


    $checkEmail = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION['checkEmail'] = $checkEmail;
}

function createUser($pdo, $username, $first_name, $last_name, $email, $password, $message)
{
    $_SESSION['successful'] = [];

    $database = "INSERT INTO Users (username, first_name, last_name, email, password) VALUES (:username, :first_name, :last_name, :email, :password);";
    $statement = $pdo->prepare($database);


    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $statement->BindParam(':username', $username);
    $statement->BindParam(':first_name', $first_name);
    $statement->BindParam(':last_name', $last_name);
    $statement->BindParam(':email', $email);
    $statement->BindParam(':password', $hashedPwd);

    $statement->execute();

    $_SESSION['successful'][] = "Your account has been created! You can now log in.";

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
    $statement = $pdo->prepare("SELECT id, username, email, password, avatar, biography FROM Users WHERE username = :username");
    $statement->BindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $userProfile = $statement->fetch(PDO::FETCH_ASSOC);

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

function fetchUsernameById($pdo, $id)
{
    $database = 'SELECT username FROM Users WHERE id = :id';
    $statement = $pdo->prepare($database);
    $statement->bindParam(':id', $id);
    $statement->execute();

    $username = $statement->fetch(PDO::FETCH_ASSOC);

    return $username;
}
