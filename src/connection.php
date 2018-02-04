<?php
$host = "localhost";
$user = "root";
$pass = "coderslab";
$db = "twitter";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Polaczenie z twitter nieudane. Blad: " .
    $conn->connect_error);
}
