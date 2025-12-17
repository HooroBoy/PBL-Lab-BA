<?php
session_start();
$title = 'Edit Karya Buku';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/KaryaBuku.php";
include "../../app/models/Dosencontroller.php";

$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;
$dataDosen = Dosen::all();

$id = $_GET['id'];
$data = KaryaBuku::find($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role == 'dosen') {
        $dosen_id = $id_dosen;
    } else {
        $dosen_id = $_POST['dosen_id'];
    }

    KaryaBuku::update($id, $dosen_id, $_POST['judul_buku'], $_POST['jumlah_halaman'], $_POST['tahun'], $_POST['penerbit']);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Karya Buku berhasil diubah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/karya_buku/view.php?halaman=buku';
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
                                <h3>Ubah Bidang Keahlian</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Ubah Bidang Keahlian
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
                                        <label for="">Dosen Penulis</label>
                                        <select name="dosen_id" class="form-control">
                                            <?php foreach ($dataDosen as $dosen) { ?>
                                                <option value="<?php echo $dosen['id']; ?>" <?= $dosen['id'] == $data['dosen_id'] ? 'selected' : '' ?>>
                                                    <?php echo $dosen['nama']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <?php endif ?>
                                    <div class="mb-3">
                                        <label>Judul Buku</label>
                                        <input type="text" name="judul_buku" class="form-control" value="<?= isset($data['judul_buku']) ? $data['judul_buku'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jumlah Halaman</label>
                                        <input type="number" name="jumlah_halaman" class="form-control" value="<?= isset($data['jumlah_halaman']) ? $data['jumlah_halaman'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" class="form-control" value="<?= isset($data['tahun']) ? $data['tahun'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Penerbit</label>
                                        <input type="text" name="penerbit" class="form-control" value="<?= isset($data['penerbit']) ? $data['penerbit'] : '' ?>" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    <a href="view.php?halaman=karya_buku" class="btn btn-secondary">Kembali</a>
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