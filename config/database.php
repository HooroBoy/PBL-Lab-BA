<?php
$host = 'localhost';
$dbname = 'PBL_LAB_BA';  
$user = 'postgres';       
$pass = '1234'; 
$port = '5432'; 
try {
    $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$pass;port=$port";
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi ke PostgreSQL gagal: " . $e->getMessage());
}
?>