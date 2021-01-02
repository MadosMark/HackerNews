<?php

declare(strict_types=1);
require __DIR__ . '/homepage/header.php';


$user = confirmUser($pdo);


?>


<section class="settings section">
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

    <form action="app/users/logout.php" class="logout">
        <button type="submit" class="button">Logout</button>
    </form>
</section>

<?php require __DIR__ . '/homepage/footer.php'; ?>