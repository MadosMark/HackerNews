<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['id'], $_POST['comment'], $_GET['id'])) {
    $commentId = $_POST['post_id'];
    $comment = $_POST['comment'];
    $userId = $_GET['id'];


    $statement = $pdo->prepare('UPDATE Comments SET comment = :comment WHERE post_id = :commentId');
    $statement->bindParam(':comment', $content);
    $statement->bindParam(':commentId', $commentId);
    $statement->execute();

    redirect('../../comments.php?id=' . $postId);
}
