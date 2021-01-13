<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['post_id'], $_POST['comment_id'])) {
    $postId = $_POST['post_id'];
    $commentId = $_POST['comment_id'];

    deleteComment($pdo, $commentId);

    redirect('../../comments.php?id=' . $postId);
}

if (isset($_POST['id'])) {
    $postId = $_POST['id'];
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];

    deletePost($pdo, $postId, $userId);

    redirect('/../../profile.php?username=' . $username);
}
