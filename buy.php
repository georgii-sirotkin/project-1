<?php

session_start();
$_SESSION['book_id'] = $_GET['book_id'];
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$currentUrlWithoutQueryString = substr($currentUrl, 0, strpos($currentUrl, '?'));
$checkoutUrl = str_replace('buy.php', 'checkout.php', $currentUrlWithoutQueryString);


header('Location: ' . $checkoutUrl);

