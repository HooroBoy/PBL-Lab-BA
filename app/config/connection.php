<?php
$host = "localhost";
$port = "5432";
$dbname = "lab_ba"; 
$user = "postgres"; 
$password = "postgres";    

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "AMAN AJA";
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
