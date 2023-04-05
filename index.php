<?php
include '_header.php';
session_start();
echo createHeader();
?>


<div class='container'>
    <div class='row'>
        <div class='jumbotron bg-light m-2 p-2'>
            <h1 class='display-4'>Welcome to the Online Bookstore!</h1>
            <p class='lead'>Browse from the latest books in our collection!</p>
            <hr class='my-4'>
        </div>
    </div>

    <h2 class="display-5 text-center">Featured Books</h2>

    <?php

    try {
        $books = getGooks();
    } catch (Exception $e) {
        echo($e->getMessage());
    }

    ?>

    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($books) && count($books) > 0): ?>
            <?php foreach ($books as $book): ?>

                <div class="card m-2" style="width: 18rem;">
                    <?php if (isLoggedIn() && isAdmin()): ?>
                        <a href="book-form.php?id=<?= $book['id'] ?>">Edit</a>
                    <?php endif; ?>
                    <img src=<?php echo $book['cover']; ?> class="card-img-top" alt="cover" class="fluid">
                    <div class="card-body">
                        <a href="view-book.php?id=<?= $book['id'] ?>"><h5
                                    class="card-title"> <?php echo $book['title']; ?></h5></a>
                        <p class="card-text"><?php echo $book['description']; ?></p>
                    </div>
                    <?php if (isLoggedIn() && isUser()): ?>
                        <form method="post" action="add-to-cart.php?id=<?= $book['id'] ?>">
                            <input type='hidden' name='id' value='<?= $book['id'] ?? '' ?>'>
                            <div class="row mb-1 mx-auto">
                                <div class="col"><input type="number" min="1" name="quantity" class="form-control"
                                                        value="1"></div>
                                <div class="col">
                                    <button type="submit" class="btn btn-secondary">Add to cart</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books available</p>
        <?php endif; ?>
    </div>

    <?php require_once '_footer.php' ?>
