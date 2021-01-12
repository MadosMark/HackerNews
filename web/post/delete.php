<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


$_SESSION['successful'] = [];
$_SESSION['errors'] = [];

if (isset($_POST['post_id'], $_POST['comment_id'], $_POST['user_id_delete_comment'])) {
    $postId = (int)$_POST['post_id'];
    $commentId = (int)$_POST['comment_id'];
    $userId =  (int)$_POST['user_id_delete_comment'];


    deleteComment($pdo, $postId, $userId, $commentId);

    $_SESSION['successful'][] = "Your comment has been deleted";

    redirect("/../comments.php?id=$postId");
}

if (isset($_POST['post_id_delete'])) {
    $userId = (int)$_SESSION['user']['id'];
    $postId = (int)$_POST['post_id_delete'];

    deletePost($pdo, $postId, $userId);


    $_SESSION['successful'][] = "Your post has been deleted";

    redirect("/profile.php");
} else {
    $_SESSION['errors'][] = "Something went wrong trying to delete your post!";
    redirect("/index.php");
}

redirect('/');
