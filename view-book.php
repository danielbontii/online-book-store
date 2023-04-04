<?php

require_once 'functions.php';
require_once '_header.php';
echo createHeader();

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $book = getBookById($id);
}

?>

<?php if (!empty($book)): ?>
<div class="">
    <div class="row mt-5">
        <div class="col d-flex justify-content-center">
            <div class="card me-5 " style="width: 18rem;">
                <img src="<?= $book['cover']; ?>" class="card-img-top" alt="...">
            </div>
            <div>
                <p><?= $book['title']; ?></p>
                <p class="h3">GHS <?= $book['price']; ?></p>
                <p><?= $book['description']; ?></p>
                <p><?= $book['author']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <p>Book not found</p>
<?php endif; ?>


<?php require_once '_footer.php' ?>

