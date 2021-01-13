<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


// if (isset($_POST['id'], $_POST['comment'], $_GET['id'])) {
//     $postId = $_POST['post_id'];
//     $commentId = $_POST['comment_id'];
//     $userId =  $_SESSION['user']['id'];
//     $comment = $_POST['comment'];

//     updateComment($pdo, $postId, $userId, $commentId, $comment);

//     $statement = $pdo->prepare('UPDATE Comments SET comment = :comment WHERE post_id = :commentId');
//     $statement->bindParam(':comment', $content);
//     $statement->bindParam(':commentId', $commentId);
//     $statement->execute();

//     redirect('../../comments.php?id=' . $postId);
// }
