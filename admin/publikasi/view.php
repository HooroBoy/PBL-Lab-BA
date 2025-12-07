<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include "../../app/models/Publikasi.php";
$data = Publikasi::all();
$title = 'Data Publikasi';
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
                                <h3>Data Publikasi</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tampil Data Publikasi
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php?halaman=publikasi">Publikasi</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Lihat Data Publikasi
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <a href="add.php?halaman=publikasi" class="btn btn-primary btn-sm mb-3">Tambah Publikasi</a>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th>
                                                <th>Jenis Publikasi</th>
                                                <th style="width: 38%;">Penulis</th>
                                                <th style="width: 12%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach ($data as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row['judul'] ?></td>
                                                        <td><?= $row['jenis_publikasi'] ?></td>
                                                        <td>
                                                            <?php foreach ($row['dosen'] as $dos): ?>
                                                                - <?php echo htmlspecialchars("{$dos['nama_dosen']} ({$dos['peran']})"); ?><br>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="edit.php?halaman=bidang_keahlian&id=<?= $row['id_publikasi'] ?>">Ubah</a>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=bidang_keahlian&id=<?= $row['id_publikasi'] ?>" onclick="return confirm('Hapus bidang keahlian ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
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