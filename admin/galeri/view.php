<?php
session_start();
$title = 'Galeri';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Galeri.php";
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : null;
$galeri = Galeri::all($kategori);
?>
<body>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            <div id="main-content">
                <div class="container py-2">
                    <div class="page-heading mb-2">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3 class="mb-1">Galeri</h3>
                                    <p class="text-subtitle text-muted mb-1">Daftar Galeri</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first text-end">
                                    <a href="add.php" class="btn btn-primary">Tambah Galeri</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <form method="get" class="row g-2 align-items-center">
                            <div class="col-auto">
                                <select name="kategori" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Kategori</option>
                                    <option value="aktivitas" <?php if($kategori=='aktivitas') echo 'selected'; ?>>Galeri Aktivitas</option>
                                    <option value="fasilitas" <?php if($kategori=='fasilitas') echo 'selected'; ?>>Galeri Fasilitas</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <?php if (empty($galeri)) { ?>
                            <div class="col-12"><div class="alert alert-info">Belum ada data galeri.</div></div>
                        <?php } ?>
                        <?php foreach ($galeri as $g) { ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <img src="<?php echo $g['gambar']; ?>" class="card-img-top" alt="Gambar Galeri" style="object-fit:cover;max-height:200px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($g['judul']); ?></h5>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($g['deskripsi'])); ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info text-dark"><?php echo ucfirst($g['kategori']); ?></span>
                                    <div>
                                        <a href="edit.php?id=<?php echo $g['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?id=<?php echo $g['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
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