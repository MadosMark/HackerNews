<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>





<?php if (isset($_GET['username'])) {
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
    $userProfile = fetchUser($pdo, $username);
    $profileId = $userProfile['id'];
    $userPosts = getUserPosts($pdo, $profileId);
} ?>


<div>


    <article class="profile_container">
        <div class="profile_page">
            <div class="profile_image">
                <h1 class="profile_username"><?php echo $userProfile['username']; ?> </h1>
                <textarea cols="40" rows="5" class="profile_biography"> <?php echo $userProfile['biography']; ?> </textarea>
                <img class="p_image" src="<?php echo ($userProfile['avatar'] !== null) ? "/uploads/avatars/" . $userProfile['avatar'] : 'assets/images/avatar.png'; ?>" id="avatar-image" alt="Avatar image">
            </div>
        </div>

        <?php if ($profileId === $_SESSION['user']['id']) : ?>
            <a href="settings.php?username=<?php echo $_SESSION['user']['username']; ?> "> <button class="edit_profile">Edit profile</button> </a>
        <?php endif; ?>
    </article>



    <h2 class="user_post_title"> Posts </h2>

    <?php if (is_array($userPosts)) {
        foreach ($userPosts as $userPost) :  ?>

            <div class="posts_container">
                <div class="user_posts">
                    <h3 class="post_title"> <?php echo $userPost['title']; ?> </h3>
                    <p> <?php echo $userPost['description']; ?> </p>
                    <a href="<?php echo $userPost['post_url'] ?> "> <?php echo $userPost['post_url']; ?> </a>
                    <p> Posted by: <?php echo $userPost['id']; ?> </p>
                    <p> <?php echo $userPost['post_date']; ?> </p>
                </div>
            </div>
            <?php if ($profileId === $_SESSION['user']['id']) : ?>
                <button class="edit_post">Edit post</button>
            <?php endif; ?>
    <?php endforeach;
    } ?>
</div>





<?php require __DIR__ . '/homepage/footer.php'; ?>