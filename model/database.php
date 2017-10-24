<?php
    $dsn = 'mysql:host=64.119.131.183;dbname=xujial';
    $username = 'xujial';
    $password = 'S8502';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }

?>