<?php
session_start();
$title = 'Edit Kategori Riset';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Kategori.php";

$id = $_GET['id'];
$data = Kategori::find($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Kategori::update($id, $_POST['nama'], $_POST['deskripsi']);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Kategori berhasil diubah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/project-azenk/admin/kategori_riset/view.php?halaman=kategori_riset';
    })
    </script>";
}
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
                                <h3>Ubah Kategori Riset</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Ubah Kategori Riset
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control" value="<?= isset($data['deskripsi']) ? $data['deskripsi'] : '' ?>">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    <a href="view.php?halaman=kategori_riset" class="btn btn-secondary">Kembali</a>
                                </form>
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
    <?= $message; ?>
</body>

</html>