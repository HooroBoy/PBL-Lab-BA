<?php
session_start();
require_once __DIR__ . "/../../app/models/PerolehanHki.php";

// --- 1. LOGIKA DATA & HAK AKSES ---
$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;

// Default kosong untuk keamanan
$perolehanAll = [];

// Logika pengambilan data yang LEBIH AMAN
if ($role == 'admin') {
    // Admin melihat semua
    $perolehanAll = PerolehanHki::all();
} elseif ($role == 'dosen') {
    // Dosen melihat dirinya sendiri
    if ($id_dosen) {
        $perolehanDosen = PerolehanHki::allByDosen($id_dosen);
        $perolehanAll = $perolehanDosen;
    } else {
        // Jika login dosen tapi ID tidak ketemu, biarkan kosong (Jangan tampilkan semua data!)
        $perolehanAll = [];
    }
}

$title = 'Data Pengalaman Perolehan HKI';
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
                                <h3>Data Pengalaman Perolehan HKI</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tampil Data Pengalaman Perolehan HKI
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php?halaman=perolehan_hki">Pengalaman Perolehan HKI</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Lihat Data Pengalaman Perolehan HKI
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <a href="add.php?halaman=perolehan_hki" class="btn btn-primary btn-sm mb-3">Tambah Perolehan HKI</a>
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
                                                <th style="width: 25%;">Judul Tema HKI</th>
                                                <th style="width: 15%;">Nomor ID</th>
                                                <th style="width: 12%;">Jenis</th>
                                                <th style="width: 10%;">Tahun</th>
                                                <th style="width: 12%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($perolehanAll) > 0) : 
                                                $i = 1;
                                                foreach ($perolehanAll as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <?php if($role == 'admin') : ?>
                                                        <td><?= $row['nama_dosen'] ?></td>
                                                        <?php endif ?>
                                                        <td><?= $row['judul_tema_hki'] ?></td>
                                                        <td><?= $row['nomor_id'] ?></td>
                                                        <td><?= $row['jenis'] ?></td>
                                                        <td><?= $row['tahun'] ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="edit.php?halaman=perolehan_hki&id=<?= $row['id'] ?>">Ubah</a>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=perolehan_hki&id=<?= $row['id'] ?>" onclick="return confirm('Hapus Perolehan HKI ini?')">Hapus</a>
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