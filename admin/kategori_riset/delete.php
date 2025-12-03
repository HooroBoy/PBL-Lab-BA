<?php
    include "../../app/models/Kategori.php";
    Kategori::delete($_GET['id']);
    // $message = "<script>
    //     Swal.fire({
    //         title: 'Berhasil',
    //         text: 'Kategori berhasil dihapus!',
    //         icon: 'success',
    //         showConfirmButton: false,
    //         timer: 2000,
    //         timerProgressBar: true,
    //     }).then(() => {
    //         window.location.href = '/project-azenk/admin/kategori_riset/view.php?halaman=kategori_riset';
    //     })
    //     </script>";
    header("Location: /project-azenk/admin/kategori_riset/view.php?halaman=kategori_riset");
?>
