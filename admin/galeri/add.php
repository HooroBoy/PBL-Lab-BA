<?php
session_start();
$title = 'Tambah Galeri';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Galeri.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gambar = '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['gambar']['name']);
        $kategori = $_POST['kategori'] ?? 'aktivitas';
        if ($kategori === 'fasilitas') {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/assets/fasilitas';
            $gambar = 'assets/fasilitas/' . $fileName;
        } else {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/assets/kegiatan';
            $gambar = 'assets/kegiatan/' . $fileName;
        }
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $targetFile = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            // $gambar sudah path relatif dari root web
        } else {
            $gambar = '';
        }
    }
    $data = [
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'gambar' => $gambar,
        'kategori' => $_POST['kategori'],
    ];
    Galeri::create($data);
    $message = "<script>Swal.fire({title: 'Berhasil', text: 'Galeri berhasil ditambah!', icon: 'success', showConfirmButton: false, timer: 2000, timerProgressBar: true,}).then(() => {window.location.href = '/PBL-Lab-BA/admin/galeri/view.php?halaman=galeri';})</script>";
}
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
                                    <h3 class="mb-1">Tambah Galeri</h3>
                                    <p class="text-subtitle text-muted mb-1">Halaman Tambah Galeri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm mb-4 w-100">
                                <div class="card-body">
                                    <?php if (!empty($message)) echo $message; ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Judul <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori" class="form-control" required>
                                                <option value="aktivitas">Galeri Aktivitas</option>
                                                <option value="fasilitas">Galeri Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar <span class="text-danger">*</span></label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Tambah Galeri</button>
                                            <a href="view.php?halaman=galeri" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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