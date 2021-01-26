<?php

declare(strict_types=1);
require __DIR__ . '/homepage/header.php';
require __DIR__ . '/homepage/navbar.php';

require __DIR__ . '/homepage/messages.php';

$user = confirmUser($pdo); ?>
<div class="settings_container">
    <div class="settings_options">
        <h2 class="settings_title">Change profile picture</h2>
        <?php if (isset($_SESSION['avatarInvalidType'])) { ?>
            <p> <?php echo $_SESSION['avatarInvalidType'][0];
                unset($_SESSION['avatarInvalidType']);
            } ?>
            <?php if (isset($_SESSION['avatarTooBig'])) { ?>
            <p> <?php echo $_SESSION['avatarTooBig'][0];
                unset($_SESSION['avatarTooBig']);
            } ?>
            <div class="settings_image_container">
                <img class="settings_image" src="<?php echo ($user['avatar'] !== null) ? "/uploads/avatars/" . $user['avatar'] : 'assets/profile_image_placeholder.png'; ?>" id="avatar-image" alt="Avatar image">
                <form action="web/user/avatar.php" method="post" enctype="multipart/form-data" class="form change-avatar__form">
                    <input class="" type="file" accept="image/jpeg,image/png" name="avatar" id="avatar" required>
                    <button type="submit" class="button_settings">Upload</button>
                </form>
            </div>
    </div>
    <div class="settings_email_container">
        <h2 class="settings_title">Change email</h2>
        <p>Current email adress: <?php echo $user['email']; ?> </p>
        <form action="web/user/email.php" method="post" class="settings_new_email">
            <input type="email" name="email" placeholder="Type in new email" required>
            <button type="submit" class="button_settings">Save</button>
        </form>
    </div>
    <div class="settings_password_container">
        <h2 class="settings_title">Change password</h2>
        <?php if (isset($_SESSION['PASSWORD_SUCCESS'])) { ?>
            <p> <?php echo $_SESSION['PASSWORD_SUCCESS'][0];
                unset($_SESSION['PASSWORD_SUCCESS']); ?>
            <?php } else if (isset($_SESSION['CURRENT_PASSWORD_INVALID'])) { ?>
            <p> <?php echo $_SESSION['CURRENT_PASSWORD_INVALID'][0];
                unset($_SESSION['CURRENT_PASSWORD_INVALID']);
            } ?> </p>
            <?php if (isset($_SESSION['PASSWORD_SHORT'])) { ?>
                <p> <?php echo $_SESSION['PASSWORD_SHORT'][0];
                    unset($_SESSION['PASSWORD_SHORT']);
                } ?>
                <p>
                    <?php if (isset($_SESSION['PASSWORD_NOT_SAME'])) { ?>
                <p> <?php echo $_SESSION['PASSWORD_NOT_SAME'][0];
                        unset($_SESSION['PASSWORD_NOT_SAME']);
                    } ?>
                <p>
                <form style="margin-top: 1rem;" action="web/user/password.php" method="post" class="settings_password_renewal">
                    <div class="settings_password_renewal">
                        <label for="current_password">Current password:</label>
                        <input type="password" name="current_password" placeholder="Type current password" required>
                        <label for="new_password">New password:</label>
                        <input type="password" name="new_password" placeholder="Type new password" required>
                        <label for="confirm_password">Confirm password:</label>
                        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="button_settings">Save</button>
                </form>
    </div>
    <div class="settings_biography_container">
        <h2 class="settings_title">Edit biography</h2>
        <?php if (isset($_SESSION['BIO_SUCCESS'])) { ?>
            <p> <?php echo $_SESSION['BIO_SUCCESS'][0];
                unset($_SESSION['BIO_SUCCESS']);
            } ?>
            </p>
            <form action="web/user/biography.php" method="post">
                <textarea name="biography" id="biography" cols="30" rows="10" placeholder="Edit your biography here"><?php echo $user['biography'] ?></textarea>
    </div>
    <div class="settings_biography_buttons">
        <button type="submit" class="button_settings">Save</button>
        <form action="web/user/logout.php" class="logout">
            <button type="submit" class="button_settings">Log Out</button>
        </form>
        </form>
    </div>


    <div class="delete_account_container">
        <h3>Delete Account?</h3>
        <form action="" class="delete_form" method="post">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            <button type="submit" class="button_settings delete_account">Delete Account</button>
        </form>
    </div>

</div>
<?php require __DIR__ . '/homepage/footer.php'; ?>
