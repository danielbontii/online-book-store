<?php

include 'connection.php';
function getGooks()
{
    try {
        $db = connect();
        $booksQuery = $db->query("SELECT * FROM books");
        return $booksQuery->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo($e->getMessage());
    }
}

function isLoggedIn(): bool
{
    return isset($_SESSION) && isset($_SESSION['authenticated']) && ($_SESSION['authenticated']);
}


function isAdmin(): bool
{
    return isset($_SESSION['userRole']) && ($_SESSION['userRole']) === 'admin';
}

function isUser(): bool
{
    return isset($_SESSION['userRole']) && ($_SESSION['userRole']) === 'user';
}

function getBookById($id)
{

    try {
        $db = connect();
        $bookQuery = $db->prepare("SELECT * FROM books WHERE id = :id");
        $bookQuery->execute(["id" => $id]);
        $book = $bookQuery->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $book;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getCartByUserId($id)
{
    try {
        $db = connect();
        $cartQuery = $db->prepare("SELECT carts.*, books.price, books.author, books.price, books.title 
         FROM carts LEFT JOIN books ON carts.book_id = books.id WHERE user_id = :id AND confirmed=:confirmed");
        $cartQuery->execute([
            "id" => $id,
            "confirmed" => 0
        ]);
        $cart = $cartQuery->fetchAll();
        $db = null;
        return $cart;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function sumCartItemPrices($cartItems): int
{
    return array_reduce($cartItems, fn($carry, $cartItem) => $carry + $cartItem['total_cost'], 0);
}
