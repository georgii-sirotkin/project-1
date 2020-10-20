<?php

function getDatabaseHandler() {
    $dsn = 'mysql:dbname=project1;host=localhost;port=33060';
    $user = 'homestead';
    $password = 'secret';
    return new PDO($dsn, $user, $password);
}

function getBookById($bookId) {
    $dbh = getDatabaseHandler();
    $sql = 'SELECT BookInventory.id, name, quantity, Authors.first_name, Authors.last_name';
    $sql .= ' FROM BookInventory JOIN Authors ON author_id = Authors.id';
    $sql .= " WHERE BookInventory.id = {$bookId}";
    $rows = $dbh->query($sql)->fetchAll();

    if (count($rows) === 0) {
        return null;
    }

    return $rows[0];
}

