<?php
session_start();
$title = 'Tambah Pengalaman Perolehan HKI';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/PerolehanHki.php";
include "../../app/models/Dosencontroller.php";

$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;
$dataDosen = Dosen::all();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role == 'dosen') {
        $dosen_id = $id_dosen;
    } else {
        $dosen_id = $_POST['dosen_id'];
    }

    PerolehanHki::create($dosen_id, $_POST['judul_tema_hki'], $_POST['jenis'], 
    $_POST['tahun'], $_POST['nomor_id']);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Perolehan HKI berhasil ditambah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/perolehan_hki/view.php?halaman=perolehan_hki';
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
                                <h3>Tambah Perolehan HKI</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tambah Perolehan HKI
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <?php if($role == 'admin') : ?>
                                    <div class="mb-3">
                                        <label for="">Dosen</label>
                                        <select name="dosen_id" class="form-control">
                                            <?php foreach ($dataDosen as $dosen) { ?>
                                                <option value="<?php echo $dosen['id']; ?>">
                                                    <?php echo $dosen['nama']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <?php endif ?>
                                    <div class="mb-3">
                                        <label>Judul Tema HKI</label>
                                        <input type="text" name="judul_tema_hki" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nomor ID</label>
                                        <input type="text" name="nomor_id" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis</label>
                                        <input type="text" name="jenis" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                                    <a href="/PBL-Lab-BA/admin/perolehan_hki/view.php?halaman=perolehan_hki" class="btn btn-secondary">Kembali</a>
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