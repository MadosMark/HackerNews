<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['id'], $_GET['id'])) {
    $postId = $_POST['id'];
    $userId = $_GET['id'];


    deleteComment($pdo, $postId, $userId);

    redirect('../../comments.php?id=' . $postId);
}
