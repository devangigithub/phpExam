<?php
$host = 'localhost';
$db = 'movie_booking';
$user = 'root'; // Change as necessary
$pass = ''; // Change as necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>