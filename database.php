<?php

$servername = "127.0.0.1";
$username = "root";
$password = "password";

$conn = new mysqli($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}

$select_db = mysqli_select_db($conn, 'acme_widget');

if (!$select_db) {
    die("Selection failed: " . mysqli_error($conn));
}
?>
