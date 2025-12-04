<?php
session_start();
include "../../app/models/Artikel.php";
if (!isset($_GET['id'])) { header('Location: view.php'); exit; }
$id = $_GET['id'];
$artikl = Artikel::find($id);
if ($artikl) {
    // Hapus file thumbnail jika ada
    if (!empty($artikl['thumbnail'])) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/' . $artikl['thumbnail'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    Artikel::delete($id);
}
header('Location: view.php?halaman=artikel');
exit;
