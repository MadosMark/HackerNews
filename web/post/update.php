<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$_SESSION['successful'] = [];
$_SESSION['errors'] = [];


if (isset($_POST['comment'], $_POST['post_id'], $_POST['comment_id'])) {
    $comment = $_POST['comment'];
    $postId = $_POST['post_id'];
    $commentId = $_POST['comment_id'];

    updateComment($pdo, $comment, $postId, $commentId);

    redirect('/../comments.php?id=' . $postId);
}


if (isset($_POST['id'], $_POST['title'], $_POST['description'], $_POST['url'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];

    updatePost($pdo, $id, $title, $description, $url, $userId);

    redirect('/../profile.php?username=' . $username);
}
