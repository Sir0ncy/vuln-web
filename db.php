<?php

$host = 'db';
$user = 'root';
$password = 'Skills39#';
$db = 'king-php-coy';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("DB Con Failed: " . $conn->connect_error);
}
?>