<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "../../app/models/Publikasi.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    Publikasi::delete($id);

    header('Location: view.php?halaman=publikasi');
    exit;
    // if ($result) {
    //     echo "<script>
    //     Swal.fire({
    //         title: 'Berhasil',
    //         text: 'Kategori berhasil dihapus!',
    //         icon: 'success',
    //         showConfirmButton: false,
    //         timer: 2000,
    //         timerProgressBar: true,
    //     }).then(() => {
    //         window.location.href = 'view.php?halaman=kategori_riset';
    //     })
    //     </script>";
    // } else {
    //     echo "<script>
    //     Swal.fire({
    //         title: 'Gagal',
    //         text: 'Gagal hapus kategori!',
    //         icon: 'error',
    //         showConfirmButton: false,
    //         timer: 2000,
    //         timerProgressBar: true,
    //     })
    //     </script>";
    // }
}
?>
