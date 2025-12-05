<?php
session_start();
include "../../app/models/Galeri.php";
if (!isset($_GET['id'])) { header('Location: view.php'); exit; }
$id = $_GET['id'];
$galeri = Galeri::find($id);
if ($galeri) {
    // Hapus file gambar jika ada
    if (!empty($galeri['gambar'])) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/' . $galeri['gambar'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    Galeri::delete($id);
}
header('Location: view.php?halaman=galeri');
exit;
