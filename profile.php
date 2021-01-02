<?php require __DIR__ . '/homepage/header.php'; ?>
<!-- <?php require __DIR__ . '/homepage/navbar.php'; ?> -->

<?php

$user = confirmUser($pdo);

if (isset($_GET['username'])) {
    $username = trim(filter_var($_GET['username'], FILTER_SANITIZE_STRING));
    $profile = fetchUserByUsername($pdo, $username);
}

?>

<section class="profile">

    <?php if (!$profile) : ?>
        <article class="profile__empty empty">
            <p>Sorry, the user does not exist.</p>
        </article>
    <?php else : ?>

        <article class="profile__header">
            <div class="profile__header--stats">
                <img src="<?php echo ($profile['avatar'] !== null) ? "/uploads/avatars/" . $profile['avatar'] : 'assets/images/avatar.png'; ?>" alt="Profile picture">

                <div class="follow">
                    <div class="follow__item following">
                        <h3>Following</h3>
                        <p class="following__number">FOLLOWING</p>
                    </div>
                    <div class="follow__item followers">
                        <h3>Followers</h3>
                        <p class="followers__number">FOLLOWERS</p>
                    </div>
                </div>
            </div>

            <div class="profile__header--details">
                <h2><?php echo $profile['username']; ?></h2>
                <p><?php echo $profile['first_name'] . ' ' . $profile['last_name']; ?></p>
                <p> <?php echo $profile['biography']; ?></p>

                <?php if ($profile['id'] === $user['id']) : ?>
                    <a href="/settings.php"><button class="button">Settings</button></a>
                <?php endif; ?>

                <?php if ($profile['id'] !== $user['id']) : ?>
                    <form method="post" class="follow__form">
                        <input type="hidden" name="profile-id" value="<?php echo $profile['id']; ?>">
                        <!-- FOLLOW BUTTON -->
                    </form>
                <?php endif; ?>
            </div>
        </article>

        <!-- <article class="profile__feed">
            <?php $posts = getUserPosts($pdo, $profile['id']); ?>

            <?php if (empty($posts)) : ?>
                <div class="posts__empty">
                    <p>You have not posted anything yet!</p>
                </div>
            <?php endif; ?>

            <?php require __DIR__ . '/posts.php'; ?>

        </article> -->

    <?php endif; ?>

</section>

<?php require __DIR__ . '/views/footer.php'; ?>