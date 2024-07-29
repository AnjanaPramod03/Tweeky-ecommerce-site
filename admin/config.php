<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anj_db";


$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


if (!$pdo) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
