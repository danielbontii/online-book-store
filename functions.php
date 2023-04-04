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
