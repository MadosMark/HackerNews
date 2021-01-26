<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {

    $userId = $_SESSION['user']['id'];

    if (isset($_POST['password'])) {

        $password = $_POST['password'];

        $statement = $pdo->prepare('SELECT * FROM Users WHERE id = :userId');
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {

            unset($user['password']);

            $postsByUser = getUserPosts($pdo, $userId);
            foreach ($postsByUser as $post) {
                $postId = $post['id'];
                deletePostAndAlldataConected($pdo, $postId, $userId);
            }

            $statement = $pdo->prepare('SELECT * FROM Comments WHERE user_id = :userId');
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();
            $commentsByUser = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($commentsByUser as $comment) {
                $commentId = $comment['id'];
                deleteCommentLikes($pdo, (int)$commentId);
                deleteCommentAndAllChildren($pdo, $commentId);
            }

            $deleteLikesByUserOnComments = 'DELETE FROM Likes_on_comments WHERE user_id = :userId';
            $statement = $pdo->prepare($deleteLikesByUserOnComments);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();

            $deleteLikesByUserOnPosts = 'DELETE FROM Likes WHERE user_id = :userId';
            $statement = $pdo->prepare($deleteLikesByUserOnPosts);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();

            $avatar = $user['avatar'];

            if (file_exists(__DIR__ . '/../../uploads/avatars/' . $avatar)) {
                unlink(__DIR__ . '/../../uploads/avatars/' . $avatar);
            }

            $deleteUserAccount = 'DELETE FROM Users WHERE id = :userId';
            $statement = $pdo->prepare($deleteUserAccount);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();

            unset($_SESSION['user']);
            $_SESSION['success'] = "Your account and all data has now been deleted. Welcome back!";
            redirect('/index.php');
        } else {
            $_SESSION['error'] = 'Try again, wrong password';
            unset($user['password']);
        }
    }
}

redirect('/../settings.php');
