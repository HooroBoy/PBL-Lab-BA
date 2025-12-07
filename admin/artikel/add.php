<?php
session_start();
$title = 'Tambah Artikel';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Artikel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thumbnail = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['thumbnail']['name']);
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/assets/artikel';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $thumbnail = 'assets/artikel/' . $fileName;
        $targetFile = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetFile)) {
            // $thumbnail sudah path relatif dari root web
        } else {
            $thumbnail = '';
        }
    }
    $data = [
        'admin_id' => $_POST['admin_id'],
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi'],
        'thumbnail' => $thumbnail,
        'tanggal' => $_POST['tanggal'],
        'tags' => $_POST['tags'],
    ];
    Artikel::create($data);
    $message = "<script>Swal.fire({title: 'Berhasil', text: 'Artikel berhasil ditambah!', icon: 'success', showConfirmButton: false, timer: 2000, timerProgressBar: true,}).then(() => {window.location.href = '/PBL-Lab-BA/admin/artikel/view.php?halaman=artikel';})</script>";
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
                                    <h3 class="mb-1">Tambah Artikel</h3>
                                    <p class="text-subtitle text-muted mb-1">Halaman Tambah Artikel</p>
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
                                            <input type="hidden" name="admin_id" value="<?= $_SESSION['id'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" value="<?= date("Y-m-d") ?>" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Isi</label>
                                            <textarea name="isi" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tags <span class="text-danger">*</span></label>
                                            <input type="text" name="tags" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                            <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Tambah Artikel</button>
                                            <a href="view.php?halaman=artikel" class="btn btn-secondary">Kembali</a>
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