<?php

require_once('helpers.php');

try {
    $dbh = getDatabaseHandler();
    $sql = 'SELECT BookInventory.id, name, quantity, Authors.first_name, Authors.last_name';
    $sql .= ' FROM BookInventory JOIN Authors ON author_id = Authors.id';
    $books = $dbh->query($sql);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

require_once('partials/header.php');
?>
    <ul class="mt-3">
<?php
    foreach ($books as $book) {
        echo "<li><a href='buy.php?book_id={$book['id']}'><strong>{$book['name']}</strong> by {$book['first_name']} {$book['last_name']} ({$book['quantity']} items)</a></li>";
    }
?>
    </ul>
<?php
require_once('partials/footer.php');
