<?php

session_start();
require_once 'functions.php';

include '_header.php';
echo createHeader();

$books = [];
if (!empty($_POST)) {

    $column = $_POST['searchField'] ?? '';
    $searchValue = $_POST['searchValue'] ?? '';
    $searchValue = $searchValue ? strtolower($searchValue) : '';

    $db = connect();
    $pattern = "%$searchValue%";

    try {
        $searchStmt = $db->prepare("SELECT * FROM books WHERE LOWER($column) LIKE :pattern");
        $searchStmt->execute([
            "pattern" => $pattern
        ]);

        $books = $searchStmt->fetchAll();
        $db = null;

    } catch (Exception $e) {
        $type = 'error';
        $message = 'Failed to update book: ' . $e->getMessage();
    }
}

?>

<?php if (!empty($books)): ?>
    <h2 class="display-5 text-center">Search Results</h2>
    <?php echo renderBooks($books) ?>
<?php else: ?>
    <?php echo renderNoContent("No books matched your search") ?>
<?php endif; ?>
