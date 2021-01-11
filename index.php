<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php

if (isset($_SESSION['user'])) : ?>
    <section class="index_page">
        <div class="greeting_user_container">

            <h1 class="index_title"><?php echo $config['title']; ?></h1>
            <?php if (isset($_SESSION['user'])) : ?>
                <p> Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</p>
            <?php endif; ?>
        </div>

        <?php $fetchPost = fetchAllPosts($pdo);
        foreach ($fetchPost as $post) : ?>
            <?php $postId = $post['id'];  ?>
            <?php $upvoteByUser = upvoteByUser($pdo, $postId, $_SESSION['user']['id']) ?>
            <?php $countComments = countComments($pdo, $postId); ?>
            <?php $countUpvotes = countUpvotes($pdo, $postId); ?>

            <div class="news_feed">
                <div>
                    <h3 class="index_post_title"> <?php echo $post['title']; ?> </h3>
                </div>
                <div>
                    <p> <?php echo $post['description']; ?> </p>
                </div>
                <div>
                    <a href="<?php echo $post['post_url'] ?> "> <?php echo $post['post_url']; ?> </a>
                </div>
                <div>
                    <p> Posted by: <?php echo $post['user_id']; ?> </p>
                </div>
                <div>
                    <p> <?php echo $post['post_date']; ?> </p>
                </div>
                <div class="upvotes_comments">
                    <a class="index_comments" href="comments.php?id= <?php echo $post['id']; ?> "> Comments: </a>
                    <?php echo $countComments; ?>
                    <p class="index_upvotes"> Upvotes:
                        <?php echo $countUpvotes; ?> </p>
                    <form action="/web/post/upvote.php" method="post">
                        <input type="hidden" name="post-id" id="post-id" value="<?php echo $post['id'] ?>">
                    </form>
                </div>
                <?php if ($upvoteByUser) : ?>
                    <button class="vote_button" type="submit">Downvote</button>
                <?php else : ?>
                    <button class="vote_button" type="submit">Upvote</button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    </section>
<?php else : ?>
    <h1>PLEASE SIGN IN TOO SEE POSTS</h1>
<?php endif; ?>

<?php require __DIR__ . '/homepage/footer.php'; ?>