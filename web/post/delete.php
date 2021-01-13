<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['post_id'], $_POST['comment_id'])) {
    $postId = $_POST['post_id'];
    $commentId = $_POST['comment_id'];

    deleteComment($pdo, $commentId);

    redirect('../../comments.php?id=' . $postId);
}
