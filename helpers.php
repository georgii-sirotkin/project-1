<?php

function getDatabaseHandler() {
    $dsn = 'mysql:dbname=project1;host=localhost;port=33060';
    $user = 'homestead';
    $password = 'secret';
    return new PDO($dsn, $user, $password);
}
