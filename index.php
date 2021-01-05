<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<section>
    <div class="newsContainer">
        <article>
            <h1><?php echo $config['title']; ?></h1>
            <p> Home Page </p>


            <?php if (isset($_SESSION['user'])) : ?>
                <p> Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</p>
            <?php endif; ?>
        </article>

        <!-- <?php $allPost = getAllPosts($pdo, $allPosts);

                foreach ($allPost as $post) : ?>
            <?php $postId = $post['id'];  ?> -->

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
            </div>
        </article>
    <?php endforeach; ?>
    </div>
</section>


<?php require __DIR__ . '/homepage/footer.php'; ?>