<?php
session_start();
require_once __DIR__ . "/../../app/models/Dosen.php";

$dosenall = Dosen::all();

$title = 'Data Dosen';
include "../../public/layouts-admin/header-admin.php";
?>

<body>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Data Dosen</h3>
                                <p class="text-subtitle text-muted">Halaman Tampil Data Dosen</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php?halaman=dosen">Dosen</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Lihat Data Dosen</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <a href="add.php?halaman=tambah_dosen" class="btn btn-primary btn-sm mb-3">Tambah Dosen</a>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>NIDN</th>
                                                <th>Email</th>
                                                <th>Program Studi</th>
                                                <th>SINTA ID</th>
                                                <th>Google Scholar ID</th>
                                                <th>LinkedIn</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                                foreach ($dosenall as $row): ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row['nama'] ?></td>
                                                        <td><?= $row['nip'] ?></td>
                                                        <td><?= $row['nidn'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['program_studi'] ?></td>
                                                        <td><?= $row['sinta_id'] ?></td>
                                                        <td><?= $row['google_scholar_id'] ?></td>
                                                        <td><?= $row['linkedin_url'] ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="edit.php?halaman=ubah_dosen&id=<?= $row['id'] ?>">Ubah</a>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=hapus_dosen&id=<?= $row['id'] ?>" onclick="return confirm('Hapus dosen ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php require("../../public/layouts-admin/footer.php") ?>
        </div>
    </div>
    <script src="../../public/assets/static/js/components/dark.js"></script>
    <script src="../../public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../public/assets/compiled/js/app.js"></script>
    <script src="../../public/assets/static/js/pages/sweetalert2.js"></script>
</body>

</html>