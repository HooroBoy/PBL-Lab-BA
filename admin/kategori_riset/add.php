<?php
session_start();
$title = 'Tambah Kategori Riset';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Kategori.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Kategori::create($_POST['nama'], $_POST['deskripsi']);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Kategori berhasil ditambah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/kategori_riset/view.php?halaman=kategori_riset';
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
                                <h3>Tambah Kategori Riset</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tambah Kategori Riset
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
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                                    <a href="/PBL-Lab-BA/admin/kategori_riset/view.php?halaman=kategori_riset" class="btn btn-secondary">Kembali</a>
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