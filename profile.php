<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>


<?php if (isset($_GET['username'])) {
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
    $userProfile = fetchUser($pdo, $username);
    $profileId = $userProfile['id'];
    $userPosts = getUserPosts($pdo, $profileId);
} ?>

<article class="profile_container">
    <div class="profile_page">
        <div class="profile_image">
            <h1 class="profile_username"><?php echo $userProfile['username']; ?> </h1>
            <p class="post_bio"><?php echo $userProfile['biography']; ?></p>
            <img class="p_image" src="<?php echo ($userProfile['avatar'] !== null) ? "/uploads/avatars/" . $userProfile['avatar'] : '/assets/profile_image_placeholder.png'; ?>" alt="Avatar image">
        </div>
    </div>
    <?php if ($profileId === $_SESSION['user']['id']) : ?>
        <a href="settings.php?username=<?php echo $_SESSION['user']['username']; ?> "><button class="edit_profile">Edit profile</button> </a>
    <?php endif; ?>
</article>

<section>
    <h2 class="user_post_title"> Posts by: <?php echo $userProfile['username']; ?> </h2>

    <?php if (is_array($userPosts)) {
        foreach ($userPosts as $userPost) :  ?>

            <?php $countUpvotes = countUpvotes($pdo, $userPost['id']); ?>

            <div class="posts_container">
                <div class="user_posts">
                    <h3 class="post_title"> <?php echo $userPost['title']; ?> </h3>
                    <p> <?php echo $userPost['description']; ?> </p>
                    <a href="<?php echo $userPost['post_url'] ?> "> <?php echo $userPost['post_url']; ?> </a>
                    <p> Posted by: <?php echo $_SESSION['user']['username']; ?> </p>
                    <p> <?php echo $userPost['post_date']; ?> </p>
                    <p> Upvotes: <?php echo $countUpvotes ?></p>
                </div>

                <div>
                    <?php if ($profileId === $_SESSION['user']['id']) : ?>
                        <h3 class="post_title">Edit Post</h3>
                        <form action="/web/post/update.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $userPost['id'] ?>">

                            <div class="input_label">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" placeholder="<?php echo $userPost['title']; ?>" required>
                            </div>

                            <div class="input_label">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" placeholder="<?php echo $userPost['description']; ?>" required>
                            </div>

                            <div class="input_label">
                                <label for="url">Post URL</label>
                                <input type="url" name="url" id="url" placeholder="<?php echo $userPost['post_url']; ?>" required>
                            </div>

                            <button type="submit">Update post</button>
                        </form>

                        <form action="/web/post/delete.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $userPost['id'] ?>">
                            <button type="submit">Delete post</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

    <?php endforeach;
    } ?>
</section>
</div>


<?php require __DIR__ . '/homepage/footer.php'; ?>