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
