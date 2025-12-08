<?php
$host = 'localhost';
$dbname = 'PBL';  // Ganti sesuai nama DB PostgreSQL kamu
$user = 'postgres';       // Default user PostgreSQL
$pass = 'rafazl';  // Sesuaikan dengan password PostgreSQL
$port = '5432'; // Sesuaikan dengan port PostgreSQL jika perlu
try {
    // DSN untuk PostgreSQL
    $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$pass;port=$port";
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi ke PostgreSQL gagal: " . $e->getMessage());
}
?>