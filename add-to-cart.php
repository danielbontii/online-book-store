<?php
session_start();
require_once 'functions.php';

if (isset($_POST)) {

    $db = connect();
    $bookId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = (int)$_POST['quantity'];
    $book = getBookById($bookId);
    $totalCost = $quantity * $book['price'];
    $userId = $_SESSION['userId'];

    $type = '';
    $message = '';
    $typeSuccess = 'success';
    $successMsg = 'Book added to cart';
    $typeFailure = 'error';
    $failureMsg = 'Book not added to cart';

    try {
        $isBookInCartStmt = $db->prepare("SELECT * FROM carts WHERE book_id=:bookId AND user_id =:userId 
                      AND confirmed=:confirmed");
        $isBookInCartStmt->execute([
            'bookId' => $bookId,
            'userId' => $userId,
            'confirmed' => 0
        ]);

        if ($isBookInCartStmt->rowCount()) {

            $cartItem = $isBookInCartStmt->fetch(PDO::FETCH_ASSOC);
            $cartItem['quantity'] = (int)$cartItem['quantity'] + $quantity;
            $cartItem['total_cost'] = (int)$cartItem['total_cost'] + $totalCost;

            $updateCartItemStmt = $db->prepare("UPDATE carts SET quantity=:quantity, total_cost=:totalCost
                WHERE user_id=:userId AND book_id=:bookId AND confirmed=:confirmed");
            $updateCartItemStmt->execute([
                'quantity' => $cartItem['quantity'],
                'totalCost' => $cartItem['total_cost'],
                'userId' => $userId,
                'bookId' => $bookId,
                'confirmed' => 0
            ]);
            $db = null;
            if ($updateCartItemStmt->rowCount()) {
                $type = $typeSuccess;
                $message = $successMsg;
            } else {
                $type = $typeFailure;
                $message = $failureMsg;
            }

        } else {

            $newCartItemStmt = $db->prepare("INSERT INTO carts(book_id, user_id, quantity, total_cost) 
                VALUES (:bookId, :userId, :quantity, :totalCost)");
            $newCartItemStmt->execute([
                "bookId" => $bookId,
                "userId" => $userId,
                "quantity" => $quantity,
                "totalCost" => $totalCost
            ]);
            $db = null;
            if ($newCartItemStmt->rowCount()) {
                $type = $typeSuccess;
                $message = $successMsg;
            } else {
                $type = $typeFailure;
                $message = $failureMsg;
            }
        }
        header('location:' . 'index.php?type=' . $type . '&message=' . $message);
    } catch (Exception $e) {
        $type = 'error';
        $message = $failureMsg . $e->getMessage();
    }
}


