<?php
include "../../config/database.php";
$message = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Ambil data dosen untuk dapatkan path foto
    $stmt = $pdo->prepare("SELECT foto FROM dosen WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $dosen = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("DELETE FROM dosen WHERE id = :id");
    $result = $stmt->execute([':id' => $id]);
    if ($result) {
        // Hapus file foto jika ada
        if (!empty($dosen['foto'])) {
            $fotoPath = '../../public' . $dosen['foto'];
            if (file_exists($fotoPath)) {
                @unlink($fotoPath);
            }
        }
        $message = "success";
    } else {
        $message = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dosen</title>
    <link rel="stylesheet" href="../../public/assets/extensions/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <script src="../../public/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script>
    <?php if ($message === "success"): ?>
        Swal.fire({
            title: 'Berhasil',
            text: 'Dosen berhasil dihapus!',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = 'view.php?halaman=dosen';
        });
    <?php elseif ($message === "error"): ?>
        Swal.fire({
            title: 'Gagal',
            text: 'Gagal hapus dosen!',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    <?php endif; ?>
    </script>
</body>
</html>
