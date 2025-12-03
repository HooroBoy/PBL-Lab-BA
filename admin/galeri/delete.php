<?php
session_start();
include "../../app/models/Galeri.php";
if (!isset($_GET['id'])) { header('Location: view.php'); exit; }
$id = $_GET['id'];
$galeri = Galeri::find($id);
if ($galeri) {
    Galeri::delete($id);
}
header('Location: view.php?halaman=galeri');
exit;
