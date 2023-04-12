<?php

include 'connection.php';
function getBooks()
{
    try {
        $db = connect();
        $booksQuery = $db->query("SELECT * FROM books");
        $books = $booksQuery->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        return $books;
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

function confirmCartItemOrders($cartItems)
{
    if (!empty($cartItems)) {
        try {
            $db = connect();

            foreach ($cartItems as $cartItem) {
                $confirmBookQuery = $db->prepare("UPDATE carts SET confirmed = 1 WHERE id = :id");
                $confirmBookQuery->execute(["id" => $cartItem['id']]);
            }
            $db = null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

function getFeaturedBooks()
{
    try {
        $db = connect();
        $booksQuery = $db->prepare("SELECT * FROM books WHERE featured=:featured");
        $booksQuery->execute([
            "featured" => 1
        ]);
        return $booksQuery->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo($e->getMessage());
    }
}

function renderBooks(array $books): string
{
    $booksHtml = '<div class="d-flex flex-wrap justify-content-center">';

    if (empty($books)) {
        return "No books available";
    }

    foreach ($books as $book) {
        $booksHtml .= '<div class="card m-2" style="width: 18rem;">';

        if (isLoggedIn() && isAdmin()) {

            $featured = $book["featured"] ? "Remove from featured" : "Add to featured";
            $booksHtml .=

                        '<div class="d-flex justify-content-between align-items-center">
                            <a href="book-form.php?id=' . $book['id'] . '"' . '>Edit</a>
                            <form method="post" action="feature-book.php">
                                <input type="hidden" name="bookId" value="' . $book['id'] . '"' . '>
                                <button type="submit" class="btn btn-secondary">' . $featured . '</button>
                            </form>
                        </div>';
        }
        $booksHtml .=
            '<img src="' . $book['cover'] . '" ' . 'class="card-img-top" alt="cover" class="fluid">
                <div class="card-body">
                    <a href="view-book.php?id=' . $book['id'] . '"' . '>
                    <h5 class="card-title"> ' . $book['title'] . '</h5></a>
                    <p class="card-text">' . $book['description'] . '</p>
                </div>';
        if (isLoggedIn() && isUser()) {
            $booksHtml .=
                '<form method="post" action="add-to-cart.php?id=' . $book['id'] . '"' . '>
                    <input type="hidden" name="id" value=' . $book['id'] . '>
                    <div class="row mb-1 mx-auto">
                        <div class="col"><input type="number" min="1" name="quantity" class="form-control"
                                                value="1"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-secondary">Add to cart</button>
                        </div>
                    </div>
                </form>';
        }
        $booksHtml .= '</div>';

    }
    $booksHtml .= '</div>';
    return $booksHtml;
}

function renderNoContent($title): string
{
    return
        '<div class="d-flex flex-wrap justify-content-center align-items-center h-25">
            <p>' . $title . '</p>
        </div>';
}

function getUniqueCategories()
{
    try {
        $db = connect();
        $categoriesQuery = $db->query("SELECT DISTINCT category AS name FROM books WHERE category IS NOT NULL");
        $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        return $categories;
    } catch (Exception $e) {
        echo($e->getMessage());
    }
}

