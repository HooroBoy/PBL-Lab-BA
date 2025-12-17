<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once '../../app/models/Peminjaman.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    Peminjaman::delete($id);
    header('Location: view.php?halaman=peminjaman');
    exit;
}
?>
