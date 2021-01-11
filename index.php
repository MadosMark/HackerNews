<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php

if (isset($_SESSION['user'])) : ?>
    <section>
        <div class="newsContainer">
            <article>
                <h1><?php echo $config['title']; ?></h1>
                <p> Home Page </p>


                <?php if (isset($_SESSION['user'])) : ?>
                    <p> Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</p>
                <?php endif; ?>
            </article>

            <?php $allPost = getAllPosts($pdo);

            foreach ($allPost as $post) : ?>
                <?php $postId = $post['id'];  ?>
                <?php $isLikedByUser = isLikedByUser($pdo, $postId, $_SESSION['user']['id']) ?>

                <?php $countComments = countComments($pdo, $postId); ?>
                <?php $countLikes = countLikes($pdo, $postId); ?>

                <article class="newsFeedPage">

                    <div class="newsFeed">
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
                            <a href="comments.php?id=<?php echo $post['id']; ?> "> Comments </a>
                            <?php echo $countComments; ?>
                        </div>

                        <div>
                            <p> Likes
                                <?php echo $countLikes; ?> </p>

                            <form action="/web/post/upvote.php" method="post">
                                <input type="hidden" name="post-id" id="post-id" value="<?php echo $post['id'] ?>">
                                <?php if ($isLikedByUser) : ?>
                                    <button type="submit">Downvote</button>

                                <?php else : ?>
                                    <button type="submit">Upvote</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>


                </article>
            <?php endforeach; ?>

        </div>
    </section>

<?php else : ?>
    <h1>PLESASE SIGN IN</h1>

<?php endif; ?>

<?php require __DIR__ . '/homepage/footer.php'; ?>