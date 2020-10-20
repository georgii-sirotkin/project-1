<?php

require_once('helpers.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    processFormData();
} else {
    displayCheckoutForm();
}

function displayCheckoutForm() {
    $bookId = (int)$_SESSION['book_id'];
    $book = null;

    try {
        $book = getBookById($bookId);
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        exit();
    }

    require_once('partials/header.php');
    require_once('partials/checkout_form.php');
    require_once('partials/footer.php');
}

function processFormData() {

}

