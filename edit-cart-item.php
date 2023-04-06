<?php

require_once 'functions.php';

if (!empty($_POST)) {

    $type = '';
    $message = '';

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $newCost = $price * $quantity;

    $db = connect();

    try {
        $updateCartItemStmt = $db->prepare("UPDATE carts SET quantity=:quantity, total_cost=:newCost WHERE id=:id");
        $updateCartItemStmt->execute([
            "quantity" => $quantity,
            "newCost" => $newCost,
            "id" => $id
        ]);
        $db = null;
        if ($updateCartItemStmt->rowCount()) {
            $type = 'success';
            $message = 'Cart Item updated successfully';
        } else {
            $type = 'error';
            $message = 'Failed to update Cart Item';
        }
    } catch (Exception $e) {
        $type = 'error';
        $message = 'Failed to update book: ' . $e->getMessage();
    }

    header('location:' . 'cart.php?type=' . $type . '&message=' . $message);
}



