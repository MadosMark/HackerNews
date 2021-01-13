<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>


<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id'];
} ?>

<?php if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postIdComment = $postId;
    $post = fetchPostbyId($pdo, $postId);
    $countComments = countComments($pdo, $postId);
    $countUpvotes = countUpvotes($pdo, $postId);
    $userComments = fetchPostsComments($pdo, $postId);
} ?>



<section class="index_page">
    <div class="greeting_user_container">
        <h1 class="index_title"><?php echo $config['title']; ?></h1>
        <p>Welcome,
            <?php if (isset($user)) : ?>
                <?php echo $user['first_name']; ?>
            <?php else : ?>
                Guest
            <?php endif; ?>
            !</p>
    </div>
    <?php $fetchPost = fetchAllPosts($pdo);
    foreach ($fetchPost as $post) : ?>
        <?php $postId = $post['id'];  ?>
        <?php $countComments = countComments($pdo, $postId); ?>
        <?php $countUpvotes = countUpvotes($pdo, $postId); ?>
        <?php if (isset($user)) : ?>
            <?php $upvoteUser = upvoteUser($pdo, $postId, $userId) ?>
        <?php endif; ?>
        <?php $fetchUsername = fetchUsernameById($pdo, $post['user_id']) ?>
        <div class="news_feed">
            <h3 class="index_post_title"> <?php echo $post['title']; ?> </h3>
            <p> <?php echo $post['description']; ?> </p>
            <a class="url_link" href="<?php echo $post['post_url'] ?> "> <?php echo $post['post_url']; ?> </a>
            <p> Posted by: <?php echo $fetchUsername['username']; ?> </p>
            <p> <?php echo $post['post_date']; ?> </p>
            <div class="upvotes_comments">
                <a class="index_comments" href="comments.php?id= <?php echo $post['id']; ?> "> Comments: <?php echo $countComments; ?> </a>
            </div>
            <div>
                <form action="web/post/upvote.php" method="post">
                    <p class="index_upvotes">Upvotes: <?php echo $countUpvotes; ?></p>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <?php if (is_array($upvoteUser)) : ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $post['id'] ?>">
                            <button class="downvote_button" type="submit">Downvote</button>
                        <?php else : ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $post['id'] ?>">
                            <button class="upvote_button" type="submit">Upvote</button>
                        <?php endif; ?>
                    <?php endif; ?>

                </form>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<?php require __DIR__ . '/homepage/footer.php'; ?>