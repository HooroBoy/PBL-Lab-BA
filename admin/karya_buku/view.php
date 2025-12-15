<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once __DIR__ . "/../../app/models/KaryaBuku.php";

// --- 1. LOGIKA DATA & HAK AKSES ---
$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;

// Default kosong untuk keamanan
$bukuAll = [];

// Logika pengambilan data yang LEBIH AMAN
if ($role == 'admin') {
    // Admin melihat semua
    $bukuAll = KaryaBuku::all();
} elseif ($role == 'dosen') {
    // Dosen melihat dirinya sendiri
    if ($id_dosen) {
        $bukuDosen = KaryaBuku::allByDosen($id_dosen);
        $bukuAll = $bukuDosen;
    } else {
        // Jika login dosen tapi ID tidak ketemu, biarkan kosong (Jangan tampilkan semua data!)
        $bukuAll = [];
    }
}

$title = 'Data Karya Buku';
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
                                <h3>Data Karya Buku</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tampil Data Karya Buku
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php?halaman=karya_buku">Karya Buku</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Lihat Data Karya Buku
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <a href="add.php?halaman=karya_buku" class="btn btn-primary btn-sm mb-3">Tambah Karya Buku</a>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul Buku</th>
                                                <th>Jumlah Halaman</th>
                                                <th>Penerbit</th>
                                                <th style="width: 15%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($bukuAll) > 0) : 
                                                $i = 1;
                                                foreach ($bukuAll as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row['judul_buku'] ?></td>
                                                        <td><?= $row['jumlah_halaman'] ?> Halaman</td>
                                                        <td><?= $row['penerbit'] ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="edit.php?halaman=karya_buku&id=<?= $row['id'] ?>">Ubah</a>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=karya_buku&id=<?= $row['id'] ?>" onclick="return confirm('Hapus Buku ini?')">Hapus</a>
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