<?php
session_start();
$title = 'Edit Galeri';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Galeri.php";
if (!isset($_GET['id'])) { header('Location: view.php'); exit; }
$id = $_GET['id'];
$galeri = Galeri::find($id);
if (!$galeri) { echo '<div class="alert alert-danger">Data tidak ditemukan.</div>'; exit; }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gambar = $galeri['gambar'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($_FILES['gambar']['name']);
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/PBL-Lab-BA/public/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $gambar = '/PBL-Lab-BA/public/uploads/' . $fileName;
        $targetFile = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            // $gambar sudah path relatif dari root web
        } else {
            $gambar = $galeri['gambar']; // fallback ke gambar lama jika gagal upload
        }
    }
    $data = [
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'gambar' => $gambar,
        'kategori' => $_POST['kategori'],
    ];
    Galeri::update($id, $data);
    $message = "<script>Swal.fire({title: 'Berhasil', text: 'Galeri berhasil diupdate!', icon: 'success', showConfirmButton: false, timer: 2000, timerProgressBar: true,}).then(() => {window.location.href = '/PBL-Lab-BA/admin/galeri/view.php?halaman=galeri';})</script>";
    $galeri = Galeri::find($id);
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
                                    <h3 class="mb-1">Edit Galeri</h3>
                                    <p class="text-subtitle text-muted mb-1">Halaman Edit Galeri</p>
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
                                            <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($galeri['judul']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"><?php echo htmlspecialchars($galeri['deskripsi']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori" class="form-control" required>
                                                <option value="aktivitas" <?php if($galeri['kategori']=='aktivitas') echo 'selected'; ?>>Galeri Aktivitas</option>
                                                <option value="fasilitas" <?php if($galeri['kategori']=='fasilitas') echo 'selected'; ?>>Galeri Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Saat Ini</label><br>
                                            <img src="<?php echo $galeri['gambar']; ?>" alt="Gambar Galeri" style="max-width:200px;max-height:150px;object-fit:cover;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Gambar</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Update Galeri</button>
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