<?php

require_once 'functions.php';

if (!empty($_POST)) {

    $type = '';
    $message = '';

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $db = connect();

    try {
        $deleteCartItemStmt = $db->prepare("DELETE FROM carts WHERE id=:id");
        $deleteCartItemStmt->execute([
            "id" => $id,
        ]);
        $db = null;
        if ($deleteCartItemStmt->rowCount()) {
            $type = 'success';
            $message = 'Cart Item deleted successfully';
        } else {
            $type = 'error';
            $message = 'Failed to delete Cart Item';
        }
    } catch (Exception $e) {
        $type = 'error';
        $message = 'Failed to update book: ' . $e->getMessage();
    }

    header('location:' . 'cart.php?type=' . $type . '&message=' . $message);
}