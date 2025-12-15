<?php
    include "../../app/models/Pengabdian.php";
    Pengabdian::delete($_GET['id']);
    // $message = "<script>
    //     Swal.fire({
    //         title: 'Berhasil',
    //         text: 'Kategori berhasil dihapus!',
    //         icon: 'success',
    //         showConfirmButton: false,
    //         timer: 2000,
    //         timerProgressBar: true,
    //     }).then(() => {
    //         window.location.href = '/PBL-Lab-BA/admin/kategori_riset/view.php?halaman=kategori_riset';
    //     })
    //     </script>";
    header("Location: /PBL-Lab-BA/admin/pengabdian/view.php?halaman=pengabdian");
?>
