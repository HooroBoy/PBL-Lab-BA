<?php
session_start();
require_once __DIR__ . "/../../app/models/Penelitian.php";

// --- 1. LOGIKA DATA & HAK AKSES ---
$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;

// Default kosong untuk keamanan
$penelitianAll = [];

// Logika pengambilan data yang LEBIH AMAN
if ($role == 'admin') {
    // Admin melihat semua
    $penelitianAll = Penelitian::all();
} elseif ($role == 'dosen') {
    // Dosen melihat dirinya sendiri
    if ($id_dosen) {
        $penelitianDosen = Penelitian::allByDosen($id_dosen);
        $penelitianAll = $penelitianDosen;
    } else {
        // Jika login dosen tapi ID tidak ketemu, biarkan kosong (Jangan tampilkan semua data!)
        $penelitianAll = [];
    }
}

$title = 'Data Pengalaman Penelitian';
include "../../public/layouts-admin/header-admin.php";
?>

<body>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <!-- Start Sidebar -->
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <!-- End Sidebar -->
        <div id="main" class="layout-navbar navbar-fixed">
            <!-- Start Header -->
            <?php require("../../public/layouts-admin/header.php") ?>
            <!-- End Header -->
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Data Pengalaman Penelitian</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tampil Data Pengalaman Penelitian
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php?halaman=penelitian">Pengalaman Penelitian</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Lihat Data Pengalaman Penelitian
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <a href="add.php?halaman=penelitian" class="btn btn-primary btn-sm mb-3">Tambah Pengalaman Penelitian</a>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 4%;">#</th>
                                                <?php if($role == 'admin') : ?>
                                                <th style="width: 20%;">Dosen</th>
                                                <?php endif ?>
                                                <th style="width: 25%;">Judul Penelitian</th>
                                                <th style="width: 10%;">Tahun</th>
                                                <th style="width: 17%;">Sumber Dana</th>
                                                <th style="width: 15%;">Jumlah Dana</th>
                                                <th style="width: 13%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($penelitianAll) > 0) : 
                                                $i = 1;
                                                foreach ($penelitianAll as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <?php if($role == 'admin') : ?>
                                                        <td><?= $row['nama_dosen'] ?></td>
                                                        <?php endif ?>
                                                        <td><?= $row['judul_penelitian'] ?></td>
                                                        <td><?= $row['tahun'] ?></td>
                                                        <td><?= $row['sumber_dana'] ?></td>
                                                        <td>Rp <?= number_format($row['jumlah_dana'], 0, ',', '.') ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="edit.php?halaman=penelitian&id=<?= $row['id'] ?>">Ubah</a>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=penelitian&id=<?= $row['id'] ?>" onclick="return confirm('Hapus Penelitian ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- Start Footer -->
            <?php require("../../public/layouts-admin/footer.php") ?>
            <!-- End Footer -->
        </div>
    </div>
    <script src="../../public/assets/static/js/components/dark.js"></script>
    <script src="../../public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../public/assets/compiled/js/app.js"></script>
    <script src="../../public/assets/static/js/pages/sweetalert2.js"></script>
</body>

</html>