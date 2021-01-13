<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['id'], $_GET['id'])) {
    $postId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    deleteComment($pdo, $postId, $userId, $commentId);

    $_SESSION['successful'][] = "Your comment has been deleted";

    redirect('../../comments.php?id=' . $postId);
}
