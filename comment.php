<?php
session_start();
require_once 'functions.php';

if (!empty($_POST)) {

    $userId = $_SESSION['userId'];
    $bookId = filter_input(INPUT_POST, 'bookId', FILTER_SANITIZE_NUMBER_INT);
    $db = connect();

    if (isset($_POST['comment'])) {


        $message = $_POST['comment'] ?? '';

        $db = connect();

        try {
            $addCommentStmt = $db->prepare("INSERT INTO comments(user_id, message, book_id) 
                VALUES (:userId, :message, :bookId)");

            $addCommentStmt->execute([
                "userId" => $userId,
                "message" => $message,
                "bookId" => $bookId
            ]);
            if ($addCommentStmt->rowCount()) {
                $type = 'success';
                $message = 'comment added successfully';
            } else {
                $type = 'error';
                $message = 'Failed to add comment';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to add comment: ' . $e->getMessage();
        }
    }

    if (isset($_POST['reply'])) {

        $commentId = filter_input(INPUT_POST, 'commentId', FILTER_SANITIZE_NUMBER_INT);

        $message = $_POST['reply'] ?? '';

        try {
            $addReplyStmt = $db->prepare("INSERT INTO replies(user_id, message, comment_id) 
                VALUES (:userId, :message, :commentId)");

            $addReplyStmt->execute([
                "userId" => $userId,
                "message" => $message,
                "commentId" => $commentId
            ]);

            if ($addReplyStmt->rowCount()) {
                $type = 'success';
                $message = 'reply added successfully';
            } else {
                $type = 'error';
                $message = 'Failed to add reply';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to add reply: ' . $e->getMessage();
        }
    }

    $db = null;

    header('location:' . 'view-book.php?id=' . $bookId . '&type=' . $type . '&message=' . $message);
}