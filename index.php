<?php
include '_header.php';
session_start();
echo createHeader();

try {
    $featuredBooks = getFeaturedBooks();
    $books = getBooks();
    $categories = getUniqueCategories();
} catch (Exception $e) {
    echo($e->getMessage());
}

?>

<?php if (isLoggedIn() && isUser()): ?>
    <div class='row text-center'>
        <div class='jumbotron bg-light m-2 p-2'>
            <h1 class='display-4'>Welcome to the Online Bookstore!</h1>
            <p class='lead'>Browse from the latest books in our collection!</p>
            <hr class='my-4'>
        </div>
    </div>
<?php endif; ?>

<div class="row  mt-5">
    <?php if (isLoggedIn() && isAdmin()): ?>
        <div class="col-2">
            <a href="book-form.php">
                <button class="btn btn-success">New Book</button>
            </a>
        </div>
    <?php endif; ?>
    <div class="col-6 text-end">
        <form method="post" action="search-filter.php">
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
    <?php if (isset($categories) && !empty($categories)): ?>
        <div class="col text-end">
            <form method="post" action="search-filter.php">
                <label for="filter">Filter by</label>
                <select class="form-control w-25  d-inline" id="filter" name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['name'] ?>"> <?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
        </div>
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
