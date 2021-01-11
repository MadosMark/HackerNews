<?php require __DIR__ . '/homepage/header.php'; ?>

<?php

if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postIdComment = $postId;

    $post = getPostbyId($pdo, $postId);

    $countComments = countComments($pdo, $postId);

    $userComments = getPostsComments($pdo, $postId);
}

?>




<article class="home-page">

    <div class="posts-wrapper">
        <div class="post-item">
            <h3 class="post-title"> <?php echo $post['title']; ?> </h3>
        </div>
        <div class="post-item">
            <p class="post-description"> <?php echo $post['description']; ?> </p>
        </div>
        <div class="post-item">
            <a href="<?php echo $post['post_url'] ?> "> <?php echo $post['post_url']; ?> </a>
        </div>
        <div class="post-item-author">
            <p> Posted by: <?php echo $post['user_id']; ?> </p>

        </div>
        <div class="post-item-date">
            <p> <?php echo $post['post_date']; ?> </p>
        </div>
        <div class="post-item-date">
            <p> Comments <?php echo $countComments; ?> </p>

        </div>

    </div>
</article>


<?php if (isset($_SESSION['user'])) : ?>

    <form action="/web/post/postComment.php" method="post">

        <?php $_SESSION['postid'] = $postIdComment; ?>

        <div class="posts-wrapper">
            <label for="comment"> Comment </label>
            <input type="text" name="comment" id="comment">
            <button type="submit" class="submit-button"> Post comment </button>

        </div>

    </form>

<?php endif; ?>

<article class="home-page">


    <?php if (isset($_SESSION['errors'])) {  ?>
        <p class="error-message"> <?php errorMessage();
                                    unset($_SESSION['errors']); //delete error message after displayed
                                } ?> </p>



        <?php if (is_array($userComments)) : ?>
            <?php foreach ($userComments as $userComment) : ?>
                <div class="posts-wrapper">
                    <div class="post-item">
                        <p> Commented by: <?php echo $userComment['username']; ?> </p>
                        <p> <?php echo $userComment['comment']; ?> </p>
                        <p> <?php echo $userComment['comment_date']; ?> </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif;
        ?>