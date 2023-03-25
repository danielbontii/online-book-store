<?php

require_once 'functions.php';

if (!empty($_POST)) {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $price = $_POST['price'] ?? '';
    $keywords = $_POST['keywords'] ?? '';
    $description = $_POST['description'] ?? '';

    $db = connect();

    if (empty($_POST['id'])) {
        try {
            $newBookStmt = $db->prepare("INSERT INTO books(title, author, price, description, keywords) VALUES (:title, :author, :price, :description, :keywords)");
            $newBookStmt->execute([
                "title" => $title,
                "author" => $author,
                "price" => $price,
                "description" => $description,
                "keywords" => $keywords
            ]);
            if ($newBookStmt->rowCount()) {
                $type = 'success';
                $message = 'Book added successfully';
            } else {
                $type = 'error';
                $message = 'Failed to add book';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Member not added: ' . $e->getMessage();
        }
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        try {
            $updateBookStmt = $db->prepare("UPDATE books SET title=:title, author=:author, price=:price, description=:description, keywords=:keywords WHERE id=:id");
            $updateBookStmt->execute([
                "title" => $title,
                "author" => $author,
                "price" => $price,
                "description" => $description,
                "keywords" => $keywords,
                "id" => $id
            ]);
            $db = null;
            if ($updateBookStmt->rowCount()) {
                $type = 'success';
                $message = 'Book updated successfully';
            } else {
                $type = 'error';
                $message = 'Failed to update book';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to update book: ' . $e->getMessage();
        }
    }

    $db = null;

    //TODO: change location to admin dashboard

    header('location:' . 'index.php?type=' . $type . '&message=' . $message);
}