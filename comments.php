<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>


<?php if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id'];
} ?>

<?php if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postIdComment = $postId;
    $post = fetchPostbyId($pdo, $postId);
    $countComments = countComments($pdo, $postId);
    $countUpvotes = countUpvotes($pdo, $postId);
    $userComments = fetchPostsComments($pdo, $postId);
} ?>

<section class="comments_wrapper">
    <?php require __DIR__ . '/homepage/messages.php'; ?>
    <div class="comment_form">
        <h1 class="post_comment_title">Post</h1>
        <div class="post_info">
            <h2><?= $post['title'] ?></h2>
            <p class="url_link"> <a href="<?= $post['post_url'] ?>"><?= $post['post_url'] ?> </a></p>
            <p><?= $post['description'] ?></p>
            <p>Posted at <?= $post['post_date'] ?></p>
            <p>Upvotes: <?php echo $countUpvotes; ?></p>
        </div>
        <?php if (isset($user)) : ?>
            <form action="web/post/postComment.php?id=<?= $post['id']; ?>" method="post">
                <div class="comment_post">
                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $postId ?>">
                    <label for="comment"> Comment: </label>
                    <input type="text" name="comment" id="comment">
                    <button type="submit" class="add_comment"> Add comment </button>
                </div>
            </form>
        <?php endif; ?>

        <h5 class="post_comment_title">Comments:</h5>
        <div class="user_comments">
            <?php foreach ($userComments as $userComment) : ?>
                <?php $fetchUsername = fetchUsernameById($pdo, $userComment['user_id']) ?>
                <?php $countedUpvotesOnComment = countUpvotesOnComment($pdo, $userComment['id']); ?>
                <?php if (isset($user)) : ?>
                    <?php $userUpvoteExist = userHasUpvoteComment($pdo, $userComment['id'], $userId); ?>
                <?php endif; ?>
                <?php if ($userComment['parent_id'] > 0) : ?>
                    <?php continue; ?>
                <?php endif; ?>
                <div class="comment_container">
                    <p><?= $userComment['comment']; ?></p>
                    <p><?= $userComment['comment_date']; ?></p>
                    <p> Commented by: <?php echo $fetchUsername['username']; ?></p>
                    <?php if (isset($user)) : ?>
                        <?php if ($user['id'] === $userComment['user_id']) : ?>
                            <form action="web/post/update.php?id=<?= $post['id']; ?>" method="post">
                                <input type="text" name="comment" id="comment" placeholder="Type comment" required>
                                <input type="hidden" name="post_id" id="post_id" value="<?= $userComment['post_id'] ?>">
                                <input type="hidden" name="comment_id" id="comment_id" value="<?= $userComment['id'] ?>">
                                <button class="edit_comment" type="submit"> Update comment </button>
                            </form>
                            <form action="web/post/delete.php?id=<?= $post['id']; ?>" method="post">
                                <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                <input type="hidden" name="comment_id" value="<?= $userComment['id'] ?>">
                                <button type="submit" class="delete_comment">Delete</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (isset($user)) : ?>
                        <button class="reply_btn" data-id="<?= $userComment['id'] ?>"> Reply</button>
                        <!--Reply form -->
                        <form class="add_reply_form" action="web/post/replies.php?id=<?= $post['id'] ?>" method="post" data-id="<?= $userComment['id'] ?>">
                            <div>
                                <input type="hidden" name="post_id" id="post_id" value="<?= $postId ?>">
                                <input type="hidden" name="comment_id" id="comment_id" value="<?= $userComment['id'] ?>">
                                <input type="hidden" name="related_id" id="comment_id" value="<?= $userComment['id'] ?>">
                                <label for="comment"> Add reply: </label>
                                <input type="text" name="comment" id="comment" placeholder="Add reply" required>
                                <button type="submit" name="add_reply" class="add_comment"> Add reply </button>
                            </div>
                        </form>
                    <?php endif; ?>
                    <form action="web/post/upvote.php" method="post">
                        <p class="index_upvotes">Upvotes: <?= $countedUpvotesOnComment; ?></p>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <?php if ($userUpvoteExist) : ?>
                                <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                <input type="hidden" name="comment_id" id="id" value="<?= $userComment['id'] ?>">
                                <button class="downvote_button" type="submit">Downvote</button>
                            <?php else : ?>
                                <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                <input type="hidden" name="comment_id" id="id" value="<?= $userComment['id'] ?>">
                                <button class="upvote_button" type="submit">Upvote</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>

                <?php $replies = fetchCommentReplies($pdo, $postId, $userComment['id']); ?>
                <?php foreach ($replies as $reply) : ?>
                    <?php $fetchUsername = fetchUsernameById($pdo, $reply['user_id']) ?>
                    <?php $countedUpvotesOnComment = countUpvotesOnComment($pdo, $reply['id']); ?>
                    <?php if (isset($user)) : ?>
                        <?php $userUpvoteExist = userHasUpvoteComment($pdo, $reply['id'], $userId); ?>
                    <?php endif; ?>
                    <div class="comment_container reply">
                        <p><?= $reply['comment']; ?></p>
                        <p><?= $reply['comment_date']; ?></p>
                        <p> Commented by: <?= $fetchUsername['username']; ?></p>
                        <?php if (isset($user)) : ?>
                            <?php if ($user['id'] === $reply['user_id']) : ?>
                                <form action="web/post/update.php?id=<?= $post['id']; ?>" method="post">
                                    <input type="text" name="comment" id="comment" placeholder="Type comment" required>
                                    <input type="hidden" name="post_id" id="post_id" value="<?= $reply['post_id'] ?>">
                                    <input type="hidden" name="comment_id" id="comment_id" value="<?= $reply['id'] ?>">
                                    <button class="edit_comment" type="submit"> Update comment </button>
                                </form>
                                <form action="web/post/delete.php?id=<?= $post['id']; ?>" method="post">
                                    <input type="hidden" name="post_id" value="<?= $reply['post_id'] ?>">
                                    <input type="hidden" name="comment_id" value="<?= $reply['id'] ?>">
                                    <button type="submit" class="delete_comment">Delete</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (isset($user)) : ?>
                            <button class="reply_btn" data-id="<?= $reply['id'] ?>"> Reply</button>
                            <!--Reply form -->
                            <form class="add_reply_form" action="web/post/replies.php?id=<?= $post['id'] ?>" method="post" data-id="<?= $reply['id'] ?>">
                                <div>
                                    <input type="hidden" name="post_id" id="post_id" value="<?= $postId ?>">
                                    <input type="hidden" name="comment_id" id="comment_id" value="<?= $reply['id'] ?>">
                                    <input type="hidden" name="related_id" id="comment_id" value="<?= $userComment['id'] ?>">
                                    <label for="comment"> Add reply: </label>
                                    <input type="text" name="comment" id="comment" placeholder="Add reply" required>
                                    <button type="submit" name="add_reply" class="add_comment"> Add reply </button>
                                </div>
                            </form>
                        <?php endif; ?>
                        <form action="web/post/upvote.php" method="post">
                            <p class="index_upvotes">Upvotes: <?= $countedUpvotesOnComment; ?></p>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <?php if ($userUpvoteExist) : ?>
                                    <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                    <input type="hidden" name="comment_id" id="id" value="<?= $reply['id'] ?>">
                                    <button class="downvote_button" type="submit">Downvote</button>
                                <?php else : ?>
                                    <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                    <input type="hidden" name="comment_id" id="id" value="<?= $reply['id'] ?>">
                                    <button class="upvote_button" type="submit">Upvote</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php $replies = fetchCommentReplies($pdo, $postId, $reply['id']);  ?>
                    <?php foreach ($replies as $reply) : ?>
                        <?php $fetchUsername = fetchUsernameById($pdo, $reply['user_id']); ?>
                        <?php $fetchUsername = fetchUsernameById($pdo, $reply['user_id']) ?>
                        <?php $countedUpvotesOnComment = countUpvotesOnComment($pdo, $reply['id']); ?>
                        <?php if (isset($user)) : ?>
                            <?php $userUpvoteExist = userHasUpvoteComment($pdo, $reply['id'], $userId); ?>
                        <?php endif; ?>
                        <div class="comment_container reply reply_on_reply">
                            <p><?= $reply['comment']; ?></p>
                            <p><?= $reply['comment_date']; ?></p>
                            <p> Commented by: <?= $fetchUsername['username']; ?></p>
                            <?php
                            if (isset($user)) : ?>
                                <?php if ($user['id'] === $reply['user_id']) : ?>
                                    <form action="web/post/update.php?id=<?= $post['id']; ?>" method="post">
                                        <input type="text" name="comment" id="comment" placeholder="Type comment" required>
                                        <input type="hidden" name="post_id" id="post_id" value="<?= $reply['post_id'] ?>">
                                        <input type="hidden" name="comment_id" id="comment_id" value="<?= $reply['id'] ?>">
                                        <button class="edit_comment" type="submit"> Update comment </button>
                                    </form>
                                    <form action="web/post/delete.php?id=<?= $post['id']; ?>" method="post">
                                        <input type="hidden" name="post_id" value="<?= $reply['post_id'] ?>">
                                        <input type="hidden" name="comment_id" value="<?= $reply['id'] ?>">
                                        <button type="submit" class="delete_comment">Delete</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                            <form action="web/post/upvote.php" method="post">
                                <p class="index_upvotes">Upvotes: <?= $countedUpvotesOnComment; ?></p>
                                <?php if (isset($_SESSION['user'])) : ?>
                                    <?php if ($userUpvoteExist) : ?>
                                        <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                        <input type="hidden" name="comment_id" id="id" value="<?= $reply['id'] ?>">
                                        <button class="downvote_button" type="submit">Downvote</button>
                                    <?php else : ?>
                                        <input type="hidden" name="post_id" value="<?= $userComment['post_id'] ?>">
                                        <input type="hidden" name="comment_id" id="id" value="<?= $reply['id'] ?>">
                                        <button class="upvote_button" type="submit">Upvote</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php endforeach; ?>

                <?php endforeach; ?>

            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/homepage/footer.php'; ?>
