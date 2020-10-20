<?php

require_once('helpers.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    processFormData();
} else {
    if (!empty($_GET['book_id'])) {
        $_SESSION['book_id'] = (int)$_GET['book_id'];
    }

    displayCheckoutForm();
}

function displayCheckoutForm($errors = []) {
    $bookId = isset($_SESSION['book_id']) ? $_SESSION['book_id'] : null;
    $book = null;

    try {
        $book = $bookId ? getBookById($bookId) : null;
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        exit();
    }

    require_once('partials/header.php');
    require_once('partials/checkout_form.php');
    require_once('partials/footer.php');
}

function processFormData() {
    $data = $_POST;
    $errors = validate($data);

    if (count($errors) > 0) {
        displayCheckoutForm($errors);
        return;
    }

    $customerId = createCustomer($data['firstName'], $data['lastName']);
    $creditCardId = createCreditCard($data['cardNumber'], $data['cardHolderName'], $data['expiration'], $data['cvv']);
    $bookId = (int)$data['bookId'];
    createOrder($bookId, $customerId, $creditCardId, 1);
    decreaseQuantity($bookId, 1);
    displaySuccessPage();
}

function validate($data) {
    $errors = [];

    if (empty($data['firstName'])) {
        $errors['firstName'] = 'First name is required';
    }

    if (empty($data['lastName'])) {
        $errors['lastName'] = 'Last name is required';
    }

    if (empty($data['paymentMethod']) || !in_array($data['paymentMethod'], ['debit', 'credit'])) {
        $errors['paymentMethod'] = 'Specify payment method.';
    }

    if (empty($data['cardHolderName'])) {
        $errors['cardHolderName'] = 'Card holder name is required';
    }

    if (empty($data['cardNumber'])) {
        $errors['cardNumber'] = 'Card number is required';
    } elseif (!ctype_digit($data['cardNumber'])) {
        $errors['cardNumber'] = 'Invalid card number';
    }

    if (empty($data['expiration'])) {
        $errors['expiration'] = 'Expiration date is required';
    }

    if (empty($data['cvv'])) {
        $errors['cvv'] = 'Security code required';
    }

    return $errors;
}

function displaySuccessPage() {
    require_once('partials/header.php');
    require_once('partials/success.php');
    require_once('partials/footer.php');
}
