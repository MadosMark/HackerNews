<?php require __DIR__ . '/homepage/header.php'; ?>

<?php if (isset($_SESSION['errors'])) {  ?>
    <p class="error-message"> <?php errorMessage();
                                unset($_SESSION['errors']); //delete error message after displayed
                            } ?> </p>



    <?php
    if (!isset($_SESSION['user'])) : ?>
        <p> You need to be logged in to submit posts! </p>

    <?php endif; ?>


    <?php if (isset($_SESSION['user'])) : ?>

        <section class="sign-up-form">
            <form action="/web/post/store.php" method="post">
                <div class="sign-up">
                    <label for="title"> Title </label>
                    <input type="text" name="title" id="title" required>

                    <label for="description"> Description </label>
                    <input type="text" name="description" id="description" placeholder="Paragraf" required>

                    <label for="url"> Url to the post </label>
                    <input type="url" name="url" id="url" placeholder="www.hackernews.com" required>


                    <button type="submit" class="submit-button"> Create post </button>


            </form>
            </div>

        </section>

    <?php endif; ?>