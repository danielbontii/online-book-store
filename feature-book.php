<?php


require_once 'functions.php';

if (!empty($_POST)) {

    $type = '';
    $message = '';

    $bookId = filter_input(INPUT_POST, 'bookId', FILTER_SANITIZE_NUMBER_INT);

    $db = connect();

    try {
        $findBookStmt = $db->prepare("SELECT * FROM books WHERE id=:id AND featured=:featured");
        $findBookStmt->execute([
            "id" => $bookId,
            "featured" => 1
        ]);
        $featuredBook = $findBookStmt->fetch();

        $featureBookStmt = $db->prepare("UPDATE books SET featured=:featured WHERE id=:id");
        $featureBookStmt->execute([
            "id" => $bookId,
            "featured" => !$featuredBook ? 1 : 0
        ]);

        $db = null;
        if ($featureBookStmt->rowCount()) {
            $type = 'success';
            $message = !$featuredBook ? 'Added featured book successfully' : 'Removed featured book successfully';
        } else {
            $type = 'error';
            $message = !$featuredBook ? 'Failed to add featured book' : 'Failed to removed featured book';;
        }
    } catch (Exception $e) {
        $type = 'error';
        $message = 'Failed to update book: ' . $e->getMessage();
    }

    header('location:' . 'index.php?type=' . $type . '&message=' . $message);
}