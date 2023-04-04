<?php

require_once 'functions.php';
require_once '_header.php';
echo createHeader();

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $book = getBookById($id);
}

?>

<?php require_once '_header.php' ?>

    <div class='row'>
        <h1 class='col-md-12 text-center border border-dark bg-secondary text-white'>Add New Book</h1>
    </div>
    <div class='row container mx-auto'>
        <form method='post' action='add-edit-book.php' enctype="multipart/form-data">
            <input type='hidden' name='id' value='<?= $book['id'] ?? '' ?>'>
            <div class="row">
                <div class='form-group my-3 col-6'>
                    <label for='title'>Title</label>
                    <input type='text' name='title' class='form-control' id='title'
                           placeholder='Enter title' required autofocus
                           value='<?= isset($book['title']) ? htmlentities($book['title']) : '' ?>'>
                </div>
                <div class='form-group my-3 col-6'>
                    <label for='author'>Author</label>
                    <input type='text' name='author' class='form-control' id='author' placeholder='Enter last name'
                           required
                           value='<?= isset($book['author']) ? htmlentities($book['author']) : '' ?>'>
                </div>
            </div>
            <div class="row">
                <div class='form-group my-3 col-4'>
                    <label for='price'>Price</label>
                    <input type='number' name='price' class='form-control' id='price'
                           placeholder='Enter price' required autofocus
                           value='<?= isset($book['price']) ? htmlentities($book['price']) : '' ?>'>
                </div>
                <div class='form-group my-3 col-8'>
                    <label for='description'>Description</label>
                    <input type='text' name='description' class='form-control' id='description'
                           placeholder='Enter description'
                           required
                           value='<?= isset($book['description']) ? htmlentities($book['description']) : '' ?>'>
                </div>
            </div>

            <div class="row">
                <div class='form-group my-3 col-4'>
                    <label for='cover'>Cover Photo</label>
                    <input type='file' name='cover' class='form-control' id='cover'
                           required autofocus
                           accept=".jpeg, .png">
                </div>
                <div class='form-group my-3 col-8'>
                    <label for='keywords'>Keywords</label>
                    <input type='text' name='keywords' class='form-control' id='keywords'
                           placeholder='Enter keywords'
                           required
                           value='<?= isset($book['keywords']) ? htmlentities($book['keywords']) : '' ?>'>
                </div>
            </div>

            <button type='submit' class='btn btn-secondary my-3' name='submit'>Submit</button>
        </form>
    </div>

<?php require_once '_footer.php' ?>