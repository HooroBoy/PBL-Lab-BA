<?php
session_start();
require_once __DIR__ . "/../../app/models/Dosencontroller.php"; // Pastikan path model benar

// Mengambil semua data dosen
$dosenall = Dosen::all();

$title = 'Data Dosen';
include "../../public/layouts-admin/header-admin.php";
?>

<style>
    /* CSS Tambahan agar kartu terlihat rapi */
    .card-dosen {
        transition: transform 0.2s;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .card-dosen:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    .img-container {
        width: 100%;
        height: 250px; /* Tinggi foto tetap */
        background-color: #f8f9fa;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Agar gambar tidak gepeng */
        object-position: top center;
    }
    .badge-bidang {
        font-size: 0.75rem;
        margin-right: 3px;
        margin-bottom: 3px;
    }
</style>

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
                        </div>
                    </div>

                    <section class="section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="add.php?halaman=tambah_dosen" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Dosen
                            </a>
                        </div>

                        <div class="row">
                            <?php foreach ($dosenall as $row): ?>
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="card card-dosen h-100">
                                        <div class="img-container">
                                            <?php
                                                $fotoPath = $row['foto'];
                                                $displayFoto = 'https://via.placeholder.com/300x300?text=No+Image'; // Default placeholder

                                                if (!empty($fotoPath)) {
                                                    // Logic path (sesuaikan dengan struktur folder Anda)
                                                    if (strpos($fotoPath, '/assets/Dosen/') !== false) {
                                                        $displayFoto = '/PBL-Lab-BA/public' . $fotoPath;
                                                    } else {
                                                        $displayFoto = '/PBL-Lab-BA/public/assets/Dosen/' . basename($fotoPath);
                                                    }
                                                }
                                            ?>
                                            <img src="<?= $displayFoto ?>" alt="Foto <?= htmlspecialchars($row['nama']) ?>">
                                        </div>

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-center mb-1"><?= htmlspecialchars($row['nama']) ?></h5>
                                            <p class="text-muted text-center small mb-3"><?= htmlspecialchars($row['program_studi']) ?></p>

                                            <div class="small mb-3 text-secondary">
                                                <div class="d-flex justify-content-between">
                                                    <span>NIP:</span>
                                                    <span class="fw-bold"><?= $row['nip'] ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>NIDN:</span>
                                                    <span class="fw-bold"><?= $row['nidn'] ?></span>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <small class="fw-bold d-block mb-1">Bidang Ahli:</small>
                                                <div class="d-flex flex-wrap">
                                                    <?php if (!empty($row['bidang'])): ?>
                                                        <?php foreach ($row['bidang'] as $bid): ?>
                                                            <span class="badge bg-light text-primary border badge-bidang">
                                                                <?= htmlspecialchars($bid['nama_bidang']) ?>
                                                            </span>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted small">-</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="mt-auto d-flex gap-2">
                                                <a href="edit.php?halaman=edit_dosen&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm flex-grow-1">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a href="delete.php?halaman=hapus_dosen&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm flex-grow-1" onclick="return confirm('Yakin ingin menghapus dosen ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (empty($dosenall)): ?>
                            <div class="alert alert-info text-center">
                                Belum ada data dosen. Silakan tambah data baru.
                            </div>
                        <?php endif; ?>

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