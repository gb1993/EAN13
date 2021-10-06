<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "barcode";;

try {
    $conn = new PDO("mysql:host=$host;dbname=" . $db, $user, $pass);
} catch (PDOExeption $e) {
    echo $e -> getMessage();
}

?>