<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php

if (isset($_SESSION['user'])) : ?>
    <section class="index_page">
        <?php $postsByUpvotes = popularUpvotes($pdo);

        foreach ($postsByUpvotes as $post) : ?>
            <?php $postId = $post['id'];  ?>
            <?php $userId = $_SESSION['user']['id'];  ?>
            <?php $countComments = countComments($pdo, $postId); ?>
            <?php $countUpvotes = countUpvotes($pdo, $postId); ?>

            <div class="news_feed">
                <h3 class="index_post_title"> <?php echo $post['title']; ?> </h3>
                <p> <?php echo $post['description']; ?> </p>
                <a href="<?php echo $post['post_url'] ?> "> <?php echo $post['post_url']; ?> </a>
                <p> Posted by: <?php echo $post['user_id']; ?> </p>
                <p> <?php echo $post['post_date']; ?> </p>
                <div class="upvotes_comments">
                    <a class="index_comments" href="comments.php?id= <?php echo $post['id']; ?> "> Comments: <?php echo $countComments; ?> </a>
                </div>
                <div>
                    <form action="web/post/upvote.php" method="post">
                        <p class="index_upvotes">Upvotes: <?php echo $countUpvotes; ?></p>
                        <?php $upvoteUser = upvoteUser($pdo, $postId, $userId) ?>
                        <?php if (is_array($upvoteUser)) : ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $post['id'] ?>">
                            <button class="downvote_button" type="submit">Downvote</button>
                        <?php else : ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $post['id'] ?>">
                            <button class="upvote_button" type="submit">Upvote</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="welcome_container">
            <h1>Welcome, please sign in.</h1>
        </div>
    <?php endif; ?>
    </section>
    <?php require __DIR__ . '/homepage/footer.php'; ?>