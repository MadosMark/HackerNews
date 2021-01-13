<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php

if (isset($_GET['id'])) {
    $userId = $_SESSION['user']['id'];


    $postId = $_GET['id'];
    $postIdComment = $postId;
    $post = fetchPostbyId($pdo, $postId);


    $countComments = countComments($pdo, $postId);
    $countUpvotes = countUpvotes($pdo, $postId);
    $userComments = fetchPostsComments($pdo, $postId);
}

?>

<div class="comment_form">
    <h1 class="post_comment_title">Post</h1>
    <div class="post_info">
        <h2><?= $post['title'] ?></h2>
        <p> <a href="<?= $post['post_url'] ?>"><?= $post['post_url'] ?> </a></p>
        <p><?= $post['description'] ?></p>
        <p>Posted at <?= $post['post_date'] ?></p>
        <p> Upvotes: <?php echo $countUpvotes; ?></p>
    </div>

    <div class="">


        <?php if (isset($_SESSION['user'])) : ?>
            <form action="web/post/postComment.php?id=<?= $post['id']; ?>" method="post">
                <div class="comment_post">
                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $postId ?>">
                    <label for="comment"> Comment: </label>
                    <input type="text" name="comment" id="comment">
                    <button type="submit" class="add_comment"> Add comment </button>
                </div>
            </form>
        <?php endif; ?>

        <h5 class="post_comment_title">Comments:</h5>

        <div class="user_comments">
            <?php foreach ($userComments as $userComment) : ?>
                <p><?= $userComment['comment']; ?></p>
                <p><?= $userComment['comment_date']; ?></p>
                <p> Commented by: <?= $userComment['user_id']; ?></p>


                <?php if ($_SESSION['user']['id'] === $userComment['user_id']) : ?>
                    <form action="web/post/update.php?id=<?= $post['id']; ?>" method="post">
                        <input type="text" name="comment" id="comment" placeholder="Type comment" <?php echo $userComment['comment']; ?>">
                        <!-- <input type="hidden" name="post_id" id="post_id" value="<?php echo $post['id']; ?>"> -->
                        <div class="">
                            <button class="edit_comment" type="submit"> Update comment </button>
                        </div>
                    </form>



                    <form action="web/post/delete.php?id=<?= $post['id']; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $userComment['post_id'] ?>">
                        <button type="submit" class="delete_comment">Delete</button>
                    </form>


        </div>

    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>


<!-- <?php require __DIR__ . '/homepage/footer.php'; ?> -->