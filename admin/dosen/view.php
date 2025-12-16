<?php
session_start();
require_once __DIR__ . "/../../app/models/Dosencontroller.php";

// --- 1. LOGIKA DATA & HAK AKSES ---
$role = $_SESSION['role'] ?? 'guest'; 
$currentDosenId = $_SESSION['dosen_id'] ?? null;

// Default kosong untuk keamanan
$dosenall = [];

// Logika pengambilan data yang LEBIH AMAN
if ($role == 'admin') {
    // Admin melihat semua
    $dosenall = Dosen::all();
} elseif ($role == 'dosen') {
    // Dosen melihat dirinya sendiri
    if ($currentDosenId) {
        $singleDosen = Dosen::find($currentDosenId);
        // Bungkus dalam array agar struktur konsisten
        $dosenall = $singleDosen ? [$singleDosen] : []; 
    } else {
        // Jika login dosen tapi ID tidak ketemu, biarkan kosong (Jangan tampilkan semua data!)
        $dosenall = [];
    }
}

$title = 'Data Dosen';
include "../../public/layouts-admin/header-admin.php";
?>

<style>
    /* CSS untuk Admin (Grid Card) */
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
        height: 250px;
        background-color: #f8f9fa;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }
    
    /* CSS Tambahan untuk Tampilan Profil Dosen (Single View) */
    .profile-header-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .bg-profile {
        background: linear-gradient(45deg, #435ebe, #304791);
        height: 150px;
        border-radius: 10px 10px 0 0;
    }
    .badge-bidang {
        font-size: 0.8rem;
        padding: 0.5em 0.8em;
        margin-right: 5px;
        margin-bottom: 5px;
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
                                <h3><?= $role == 'dosen' ? 'Profil Saya' : 'Data Dosen' ?></h3>
                                <p class="text-subtitle text-muted">
                                    <?= $role == 'dosen' ? 'Kelola informasi profil dan data akademik Anda' : 'Kelola seluruh data dosen di sistem' ?>
                                </p>
                            </div>
                            <!-- <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php?halaman=dosen">Dosen</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?= $role == 'dosen' ? 'Profil' : 'Lihat Data' ?></li>
                                    </ol>
                                </nav>
                            </div> -->
                        </div>
                    </div>

                    <section class="section">
                        
                        <?php if ($role == 'dosen'): ?>
                            
                            <?php if (!empty($dosenall)): ?>
                                <?php 
                                    // PERBAIKAN: Gunakan reset() untuk mengambil elemen pertama array apapun key-nya
                                    $row = reset($dosenall); 
                                ?>
                                <div class="card shadow-sm">
                                    <div class="bg-profile"></div>
                                    <div class="card-body pt-0 relative">
                                        <div class="d-flex flex-column flex-md-row align-items-center align-items-md-end mb-4" style="margin-top: -75px;">
                                            <div class="me-md-4 mb-3 mb-md-0">
                                                <?php
                                                    $fotoPath = $row['foto'] ?? '';
                                                    $displayFoto = 'https://via.placeholder.com/300x300?text=No+Image';
                                                    if (!empty($fotoPath)) {
                                                        if (strpos($fotoPath, '/assets/Dosen/') !== false) {
                                                            $displayFoto = '/PBL-Lab-BA/public' . $fotoPath;
                                                        } else {
                                                            $displayFoto = '/PBL-Lab-BA/public/assets/Dosen/' . basename($fotoPath);
                                                        }
                                                    }
                                                ?>
                                                <img src="<?= $displayFoto ?>" alt="Foto Profil" class="profile-header-img bg-white">
                                            </div>
                                            <div class="text-center text-md-start flex-grow-1">
                                                <h3 class="mb-1 text-white"><?= htmlspecialchars($row['nama'] ?? '') ?></h3>
                                                <p class="mb-0 text-white"><?= htmlspecialchars($row['program_studi'] ?? '-') ?></p>
                                            </div>
                                            <div class="mt-3 mt-md-0">
                                                <a href="edit.php?halaman=edit_dosen&id=<?= $row['id'] ?>" class="btn btn-warning px-4">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit Profil
                                                </a>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row mt-4">
                                            <div class="col-md-6 mb-4">
                                                <h5 class="mb-3 text-primary"><i class="bi bi-person-badge me-2"></i>Informasi Akademik</h5>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td width="30%" class="text-muted">NIP</td>
                                                        <td class="fw-bold"><?= htmlspecialchars($row['nip'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">NIDN</td>
                                                        <td class="fw-bold"><?= htmlspecialchars($row['nidn'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Email</td>
                                                        <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <h5 class="mb-3 text-primary"><i class="bi bi-journal-check me-2"></i>Bidang Keahlian</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <?php if (!empty($row['bidang'])): ?>
                                                        <?php foreach ($row['bidang'] as $bid): ?>
                                                            <span class="badge bg-primary badge-bidang rounded-pill">
                                                                <?= htmlspecialchars($bid['nama_bidang']) ?>
                                                            </span>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted fst-italic">Belum ada data bidang keahlian.</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <h5 class="mb-3 text-primary"><i class="bi bi-link-45deg me-2"></i>Tautan Eksternal</h5>
                                                <div class="d-flex gap-3">
                                                    <?php if(!empty($row['sinta_id'])): ?>
                                                        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-bookmarks"></i> Sinta ID: <?= $row['sinta_id'] ?></a>
                                                    <?php endif; ?>
                                                    <?php if(!empty($row['google_scholar_id'])): ?>
                                                        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-google"></i> Google Scholar</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <h4 class="alert-heading">Data Profil Tidak Ditemukan</h4>
                                    <p>Sistem tidak dapat menemukan data profil Dosen yang terkait dengan akun Anda.</p>
                                    <hr>
                                    <p class="mb-0">Kemungkinan penyebab: Akun Anda belum dihubungkan dengan Data Dosen, atau Session Login telah berakhir. Silakan Logout dan Login kembali.</p>
                                </div>
                            <?php endif; ?>


                        <?php else: ?>
                            
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
                                                    $fotoPath = $row['foto'] ?? '';
                                                    $displayFoto = 'https://via.placeholder.com/300x300?text=No+Image';
                                                    if (!empty($fotoPath)) {
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