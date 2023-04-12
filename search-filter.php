<?php

session_start();
require_once 'functions.php';

include '_header.php';
echo createHeader();

$books = [];
if (!empty($_POST)) {

    $type = isset($_POST['searchField']) ? "search" : "filter";

    $text = [
        "heading" => [
            "filter" => "Filter Results",
            "search" => "Search Results"
        ],
        "noContent" => [
            "filter" => "No results for the filter",
            "search" => "No books matched your search"
        ]
    ];

    if (isset($_POST['searchField'])) {
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
            $message = 'Failed to search book: ' . $e->getMessage();
        }
    }

    if (isset($_POST['category'])) {
        $category = $_POST['category'] ?? '';

        $db = connect();

        try {
            $filterStmt = $db->prepare("SELECT * FROM books WHERE category=:category");
            $filterStmt->execute([
                "category" => $category
            ]);

            $books = $filterStmt->fetchAll();
            $db = null;
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to filter books: ' . $e->getMessage();
        }
    }
}

?>

<?php if (!empty($books)): ?>
    <h2 class="display-5 text-center"><?= isset($type) && isset($text) ? $text['heading'][$type] : 'Results' ?></h2>
    <?php echo renderBooks($books) ?>
<?php else: ?>
    <?php echo renderNoContent(isset($type) && isset($text) ? $text['noContent'][$type] : 'No content') ?>
<?php endif; ?>
