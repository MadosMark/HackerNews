<?php require __DIR__ . '/homepage/header.php'; ?>
<?php require __DIR__ . '/homepage/navbar.php'; ?>

<?php

$id = $_GET['id'];
$statement = $pdo->prepare('SELECT * FROM Posts WHERE id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);

// select the data from the comments table

$statement = $pdo->prepare('SELECT * FROM Comments WHERE post_id = :postId ORDER BY comment_date DESC');
$statement->bindParam(':postId', $id, PDO::PARAM_INT);
$statement->execute();


$comments = $statement->fetchAll(PDO::FETCH_ASSOC); ?>

<article>
    <h2><?= $post['title'] ?></h2>
    <p> <a href="<?= $post['post_url'] ?>"><?= $post['post_url'] ?> </a></p>
    <p><?= $post['description'] ?></p>
    <small>Posted at <?= $post['post_date'] ?></small>
    <hr>
</article>

<div>
    <div class="comments-displayed">
        <hr>
        <h5>Comments</h5>
        <?php foreach ($comments as $comment) : ?>
            <small><?= $comment['user_id']; ?> commented on</small>
            <small><?= $comment['comment_date']; ?></small>
            <p><?= $comment['comment']; ?></p>
        <?php endforeach; ?>
    </div>

    <div class="delete-com">
        <form action="web/post/delete.php?id=<?= $post['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?= $comment['post_id'] ?>">
            <button type="submit" class="btn  btn-sm btn-danger">Delete</button>
        </form>
    </div>

</div>

<?php require __DIR__ . '/homepage/footer.php'; ?>