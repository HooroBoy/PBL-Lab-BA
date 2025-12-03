<?php
require_once '../controller/PeminjamanController.php';

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $no_induk = $_POST['no_induk'] ?? '';
    $tanggal_mulai = $_POST['tanggal_mulai'] ?? ''; // Format: YYYY-MM-DD
    $tanggal_selesai = $_POST['tanggal_selesai'] ?? ''; // Format: YYYY-MM-DD
    $jam_mulai = $_POST['mulai'] ?? ''; // Format: HH:MM
    $jam_selesai = $_POST['selesai'] ?? ''; // Format: HH:MM
    $keperluan = $_POST['keperluan'] ?? '';

    // Panggil fungsi controller dengan parameter terpisah
    // TIDAK PERLU digabung (concatenation) lagi
    if(PeminjamanController::isSlotAvailable($tanggal_mulai, $tanggal_selesai, $jam_mulai,$jam_selesai)){

        $result = PeminjamanController::insertJadwal(
            $nama, 
            $no_induk, 
            $tanggal_mulai, 
            $tanggal_selesai, 
            $jam_mulai, 
            $jam_selesai, 
            $keperluan
        );
    }
    
    $message = $result; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    
    <?php if ($message): ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show" role="alert">
                    <?= $message['msg'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Form Pengajuan Peminjaman</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Peminjam</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Induk (NIP/NIM)</label>
                            <input type="text" name="no_induk" class="form-control" placeholder="Contoh: 12345678" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Mulai Peminjaman</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Selesai Peminjaman</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Jam Mulai</label>
                                <input type="time" name="mulai" class="form-control" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Jam Selesai</label>
                                <input type="time" name="selesai" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keperluan</label>
                            <textarea name="keperluan" class="form-control" rows="3" placeholder="Jelaskan keperluan peminjaman..." required></textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Kirim Pengajuan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>