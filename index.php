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

    <div class="row  mt-5">
        <?php if (isLoggedIn() && isAdmin()): ?>
            <div class="col-4">
                <a href="book-form.php">
                    <button class="btn btn-success">New Book</button>
                </a>
            </div>
        <?php endif; ?>
        <div class="col text-center">
            <form method="post" action="search.php">
                <label for="searchField">Search by</label>
                <select class="form-control w-25  d-inline" id="searchField" name="searchField">
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="keywords">Keyword</option>
                </select>
                <input type="text" class="form-control d-inline w-50" required name="searchValue">
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
        </div>

    </div>


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
