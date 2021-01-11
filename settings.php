<?php

declare(strict_types=1);
require __DIR__ . '/homepage/header.php';
require __DIR__ . '/homepage/navbar.php';


$user = confirmUser($pdo); ?>

<section class="settings section">

    <article class="settings__menu__item change-avatar">
        <h2>Change profile picture</h2>
        <?php if (isset($_SESSION['avatarInvalidType'])) { ?>
            <p> <?php echo $_SESSION['avatarInvalidType'][0];
                unset($_SESSION['avatarInvalidType']);
            } ?>
            <?php if (isset($_SESSION['avatarTooBig'])) { ?>
            <p> <?php echo $_SESSION['avatarTooBig'][0];
                unset($_SESSION['avatarTooBig']);
            } ?>

            <div class="settings__menu__item--active change-avatar--active hidden">

                <img width="200px" height="200px" src="<?php echo ($user['avatar'] !== null) ? "/uploads/avatars/" . $user['avatar'] : 'assets/images/avatar.png'; ?>" id="avatar-image" alt="Avatar image">

                <form action="web/user/avatar.php" method="post" enctype="multipart/form-data" class="form change-avatar__form">
                    <div class="form__group">
                        <input class="form-control" type="file" accept="image/jpeg,image/png" name="avatar" id="avatar" required>
                    </div>

                    <button type="submit" class="button">Upload</button>
                </form>
            </div>
    </article>


    <article class="settings__menu__item change-email">
        <h2>Change email</h2>

        <div class="settings__menu__item--active change-email--active hidden">
            <div class="message hidden">
                <p></p>
            </div>

            <p>Current email adress: <?php echo $user['email']; ?></p>

            <?php if (isset($_SESSION['successful'])) { ?>
                <p> <?php echo $_SESSION['successful'][0];
                    unset($_SESSION['successful']); ?>
                <?php } else if (isset($_SESSION['emailExist'])) { ?>
                <p> <?php echo $_SESSION['emailExist'][0];
                    unset($_SESSION['emailExist']);
                } ?> </p>

                <form action="web/user/email.php" method="post" class="form change-email__form">
                    <div class="form__group">
                        <input class="form-control" type="email" name="email" placeholder="Type in your new emailadress" required>
                    </div>

                    <button type="submit" class="button">Save</button>
                </form>
        </div>
    </article>

    <article class="settings__menu__item change-password">
        <h2>Change password</h2>


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


                <div class="settings__menu__item--active change-password--active hidden">
                    <div class="message hidden">
                        <p></p>
                    </div>

                    <form action="web/user/password.php" method="post" class="form change-password__form">
                        <div class="form__group">
                            <label for="current_password">Current password</label>
                            <input type="password" name="current_password" placeholder="Type in your current password" required>
                        </div>

                        <div class="form__group">
                            <label for="new_password">New password</label>
                            <input type="password" name="new_password" placeholder="Type in your new password" required>
                        </div>

                        <div class="form__group">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password" name="confirm_password" placeholder="Confirm your new password" required>
                        </div>

                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
    </article>

    <article class="settings__menu__item change-biography">
        <h2>Edit biography</h2>

        <?php if (isset($_SESSION['BIO_SUCCESS'])) { ?>
            <p> <?php echo $_SESSION['BIO_SUCCESS'][0];
                unset($_SESSION['BIO_SUCCESS']);
            } ?>
            <p>

            <div class="settings__menu__item--active change-biography--active hidden">
                <div class="message hidden">
                    <p></p>
                </div>

                <form action="web/user/biography.php" method="post" class="form change-biography__form">
                    <div class="form__group">
                        <textarea name="biography" id="biography" cols="30" rows="10" placeholder="Edit your biography here"><?php echo $user['biography'] ?></textarea>
                    </div>

                    <button type="submit" class="button">Save</button>
                </form>
            </div>
    </article>

    <form action="web/user/logout.php" class="logout">
        <button type="submit" class="button">Log Out</button>
    </form>
</section>

<?php require __DIR__ . '/homepage/footer.php'; ?>