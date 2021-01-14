<?php

declare(strict_types=1);


require __DIR__ . '/../autoload.php';

if (isset($_POST['title'], $_POST['description'], $_POST['url'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $postUrl = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $userId = $_SESSION['user']['id'];
    $postDate = date("Y-m-d h:m");




    $database = "INSERT INTO Posts (title, description, post_url, post_date, user_id) VALUES (:title, :postDescription, :postUrl, :postDate, :userId);";
    $statement = $pdo->prepare($database);


    $statement->BindParam(':title', $title);
    $statement->BindParam(':postDescription', $description);
    $statement->BindParam(':postUrl', $postUrl);
    $statement->BindParam(':postDate', $postDate);
    $statement->BindParam(':userId', $userId);

    $statement->execute();



    redirect("/index.php");
}
