<?php
include '_header.php';
session_start();
echo createHeader();

try {
    $featuredBooks = getFeaturedBooks();
    $books = getBooks();
} catch (Exception $e) {
    echo($e->getMessage());
}

?>


<div class='container'>
    <?php if (isLoggedIn() && isUser()): ?>
        <div class='row'>
            <div class='jumbotron bg-light m-2 p-2'>
                <h1 class='display-4'>Welcome to the Online Bookstore!</h1>
                <p class='lead'>Browse from the latest books in our collection!</p>
                <hr class='my-4'>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isLoggedIn() && isAdmin()): ?>
        <a href="book-form.php"><button class="btn btn-success mt-5">New Book</button></a>
    <?php endif; ?>

    <?php if (isset($featuredBooks) && !empty($featuredBooks) > 0): ?>
        <h2 class="display-5 text-center">Featured Books</h2>
        <?php echo renderBooks($featuredBooks) ?>
    <?php endif; ?>

    <?php if (isset($books) && !empty($books)): ?>
        <h2 class="display-5 text-center">All Books</h2>
        <?php echo renderBooks($books) ?>
    <?php else: ?>
        <?php echo renderNoContent("No books available at the moment") ?>
    <?php endif; ?>

    <?php require_once '_footer.php' ?>
