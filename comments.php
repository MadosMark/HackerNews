<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postIdComment = $postId;
    $post = getPostbyId($pdo, $postId);
    $countComments = countComments($pdo, $postId);
    $userComments = getPostsComments($pdo, $postId);
} ?>


<section class="comment_form">
    <h1 class="comment_title">Post Comment</h1>
    <div class="post_info">
        <h2 class="post_title"> <?php echo $post['title']; ?> </h2>
        <p class="post_description"> <?php echo $post['description']; ?> </p>
        <a href="<?php echo $post['post_url'] ?> "> <?php echo $post['post_url']; ?> </a>
        <p> Posted by: <?php echo $post['user_id']; ?> </p>
        <p> <?php echo $post['post_date']; ?> </p>
        <p> Comments: <?php echo $countComments; ?> </p>
    </div>
    <?php if (isset($_SESSION['user'])) : ?>
        <form action="/web/post/postComment.php" method="post">
            <?php $_SESSION['postid'] = $postIdComment; ?>
            <div class="comment_post">
                <label for="comment"></label>
                <input type="text" name="comment" id="comment" placeholder="Enter Comment">
                <button type="submit" class="comment_button"> Post Comment </button>
            </div>
        </form>
    <?php endif; ?>
    <h2 class="comment_user_title">Comments:</h2>
    <?php if (is_array($userComments)) : ?>
        <?php foreach ($userComments as $userComment) : ?>
            <?php if ($userComment['user_id'] === $_SESSION['user']['id']) : ?>
                <form action="/web/post/update.php" method="post">
                    <div class="user_comments">
                        <p class="comment_text"> <?php echo $userComment['comment']; ?> </p>
                        <p> <?php echo $userComment['comment_date']; ?> </p>
                        <p> Commented by: <?php echo $userComment['username']; ?> </p>
                        <button class="edit_comment"> Edit Comment </button>
                        <form action="/web/post/delete.php" method="post">
                            <button type="submit" class="delete_comment"> Delete comment </button>
                        </form>

                    </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
</section>

<?php require __DIR__ . '/homepage/footer.php'; ?>