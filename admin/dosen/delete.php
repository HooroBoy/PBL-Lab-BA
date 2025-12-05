<?php
include "./function/connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM dosen WHERE id = :id");
    $result = $stmt->execute([':id' => $id]);
    if ($result) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil',
            text: 'Kategori berhasil dihapus!',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = 'index.php?halaman=kategori_riset';
        })
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Gagal hapus kategori!',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })
        </script>";
    }
}
?>
