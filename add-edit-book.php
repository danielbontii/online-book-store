<?php

require_once 'functions.php';

if (!empty($_POST)) {

    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $keywords = $_POST['keywords'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $cover = uploadImage();

    $db = connect();

    if (empty($_POST['id'])) {
        try {
            $newBookStmt = $db->prepare("INSERT INTO books(title, author, price, description, keywords, cover, category) 
                VALUES (:title, :author, :price, :description, :keywords, :cover, :category)");
            $newBookStmt->execute([
                "title" => $title,
                "author" => $author,
                "price" => $price,
                "description" => $description,
                "keywords" => $keywords,
                "cover" => $cover,
                "category" => $category
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
            $message = 'Book not added: ' . $e->getMessage();
        }
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        try {
            $updateBookStmt = $db->prepare(
                "UPDATE books SET title=:title, author=:author, price=:price, description=:description,
                 keywords=:keywords, cover=:cover, category=:category WHERE id=:id"
            );
            $updateBookStmt->execute([
                "title" => $title,
                "author" => $author,
                "price" => $price,
                "description" => $description,
                "keywords" => $keywords,
                "id" => $id,
                "cover" => $cover ?? '',
                "category" => $category
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

    header('location:' . 'index.php?type=' . $type . '&message=' . $message);
}

function uploadImage(): string
{
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["cover"]["name"]);
    move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile);
    return $targetFile;

}