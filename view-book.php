<?php
session_start();
require_once 'functions.php';
require_once '_header.php';
echo createHeader();

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    try {
        $book = getBookById($id);
        $comments = getBookCommentsWithReplies($id);
        var_dump($comments);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<?php if (!empty($book)): ?>
    <div class="">
        <div class="row mt-5">
            <div class="col d-flex justify-content-center">
                <div class="card me-5 border-0" style="width: 18rem;">
                    <img src="<?= $book['cover']; ?>" class="card-img-top" alt="book cover">
                </div>
                <div class="w-50">
                    <p class="mb-0 fw-bolder">Title</p>
                    <p><?= $book['title']; ?></p>

                    <p class="mb-0 fw-bolder">Price</p>
                    <p class="h3">GHS <?= $book['price']; ?></p>

                    <p class="mb-0 fw-bolder">Description</p>
                    <p><?= $book['description']; ?></p>

                    <p class="mb-0 fw-bolder">Author</p>
                    <p><?= $book['author']; ?></p>

                    <?php if (isLoggedIn()): ?>
                        <form method="post" action="comment.php">
                            <input type="hidden" name="bookId" value="<?= $book['id'] ?? '' ?>">
                            <div class="form-group">
                                <label for="comment">Add Comment</label>
                                <input type="text" class="form-control d-inline" id="comment" name="comment" required>
                                <button type="submit" class="form-control btn btn-success d-inline w-25">
                                    Post
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                    <?php if (!empty($comments)): ?>
                        <hr/>
                        <?php foreach ($comments as $comment): ?>
                            <p>
                                <?= $comment['message'] ?? 'comment unavailable' ?>
                                [<?= $comment['username'] ?? 'Username unavailable' ?>]
                            </p>
                            <div class="ms-5">
                                <form method="post" action="comment.php">
                                    <input type="hidden" name="commentId" value="<?= $comment['id'] ?? '' ?>">
                                    <div class="form-group">
                                        <label for="reply">Add Reply</label>
                                        <input type="text" class="form-control d-inline" id="reply" name="reply"
                                               required>
                                        <button type="submit" class="form-control btn btn-success d-inline w-25">
                                            Post
                                        </button>
                                    </div>
                                </form>
                            </div>


                            <?php if (!empty($comments['replies'])): ?>
                                <hr/>
                                <?php foreach ($comments['replies'] as $reply): ?>
                                    <p>
                                        <?= $reply['message'] ?? 'comment unavailable' ?>
                                        [<?= $reply['username'] ?? 'Username unavailable' ?>]
                                    </p>
                                    <div class="ms-5">
                                        <form method="post" action="comment.php">
                                            <input type="hidden" name="commentId" value="<?= $comment['id'] ?? '' ?>">
                                            <input type="hidden" name="bookId" value="<?= $book['id'] ?? '' ?>">
                                            <div class="form-group">
                                                <label for="reply">Add Reply</label>
                                                <input type="text" class="form-control d-inline" id="reply" name="reply"
                                                       required>
                                                <button type="submit"
                                                        class="form-control btn btn-success d-inline w-25">
                                                    Post
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php echo renderNoContent("Book not found") ?>
<?php endif; ?>


<?php require_once '_footer.php' ?>

