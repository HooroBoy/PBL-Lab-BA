<?php
session_start();
$title = 'Edit Artikel';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Artikel.php";

if (!isset($_GET['id'])) { header('Location: view.php?halaman=artikel'); exit; }

$id = $_GET['id'];
$artikl = Artikel::find($id);

if (!$artikl) { echo '<div class="alert alert-danger">Data tidak ditemukan.</div>'; exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thumbnail = $artikl['thumbnail'];

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
            $thumbnail = $artikl['thumbnail']; // fallback ke thumbnail lama jika gagal upload
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
    Artikel::update($id, $data);
    $message = "<script>Swal.fire({title: 'Berhasil', text: 'Artikel berhasil diupdate!', icon: 'success', showConfirmButton: false, timer: 2000, timerProgressBar: true,}).then(() => {window.location.href = '/PBL-Lab-BA/admin/artikel/view.php?halaman=artikel';})</script>";
    $artikl = Artikel::find($id);
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
                                    <h3 class="mb-1">Edit Artikel</h3>
                                    <p class="text-subtitle text-muted mb-1">Halaman Edit Artikel</p>
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
                                            <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($artikl['judul']); ?>" required>
                                            <input type="hidden" name="admin_id" value="<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Isi</label>
                                            <textarea name="isi" class="form-control"><?php echo htmlspecialchars($artikl['isi']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" value="<?= $artikl['tanggal'] ?>" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tags <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $artikl['tags'] ?>" name="tags" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Thumbnail Saat Ini</label><br>
                                            <img src="../../public/<?php echo $artikl['thumbnail']; ?>" alt="Thumbnail Artikel" style="max-width:200px;max-height:150px;object-fit:cover;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Thumbnail</label>
                                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Update Artikel</button>
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