<?php require_once '_header.php' ?>

<div class='container'>
    <div class='row'>
        <div class='jumbotron bg-light m-2 p-2'>
            <h1 class='display-4'>Welcome to the Online Bookstore!</h1>
            <p class='lead'>Browse from the latest books in our collection!</p>
            <hr class='my-4'>
        </div>
    </div>

    <h2 class="display-5">Featured Books</h2>

    <?php

    include "functions.php";

    try {
        $books = getGooks();
    } catch (Exception $e) {
        echo($e->getMessage());
    }

    ?>

    <div class="d-flex flex-wrap">
        <?php if (isset($books) && count($books) > 0): ?>
            <?php foreach ($books as $book): ?>
                <div class="card m-2" style="width: 18rem;">
                    <a href="add-edit-book.php?id=<?= $book['id'] ?>">Edit</a>
                    <img src=<?php echo $book['cover']; ?> class="card-img-top" alt="cover" class="fluid">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $book['title']; ?></h5>
                        <p class="card-text"><?php echo $book['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books available</p>
        <?php endif; ?>
    </div>

    <?php require_once '_footer.php' ?>
