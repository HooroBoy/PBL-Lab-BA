<?php
session_start();
$title = 'Artikel';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Artikel.php";
$artikl = Artikel::all();
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
                                    <h3 class="mb-1">Artikel</h3>
                                    <p class="text-subtitle text-muted mb-1">Daftar Artikel</p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first text-end">
                                    <a href="add.php?halaman=artikel" class="btn btn-primary">Tambah Artikel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (empty($artikl)) { ?>
                            <div class="col-12"><div class="alert alert-info">Belum ada data artikel.</div></div>
                        <?php } ?>
                        <?php foreach ($artikl as $art) { ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <img src="../../public/<?php echo $art['thumbnail']; ?>" class="card-img-top" alt="Thummbnail Artikel" style="object-fit:cover;max-height:150px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($art['judul']); ?></h5>
                                    <p class="card-text"><?php echo nl2br(substr($art['isi'], 0, 20)); ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="edit.php?halaman=artikel&id=<?php echo $art['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?id=<?php echo $art['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</a>
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