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


if (isset($_POST['post_id_edit'], $_POST['user_id'], $_POST['title'], $_POST['description'], $_POST['url'])) {

    $postId = $_POST['post_id_edit'];
    $userId = $_POST['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = $_POST['url'];

    updatePost($pdo, $postId, $userId, $title, $description, $url);

    $_SESSION['successful'][] = "Your post has been updated";

    redirect('/../comments.php?id=' . $postId);
}
