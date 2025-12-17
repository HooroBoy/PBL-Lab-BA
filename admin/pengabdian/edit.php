<?php
session_start();
$title = 'Edit Pengalaman Pengabdian';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Pengabdian.php";
include "../../app/models/Dosencontroller.php";

$role = $_SESSION['role'] ?? 'guest'; 
$id_dosen = $_SESSION['dosen_id'] ?? null;
$dataDosen = Dosen::all();

$id = $_GET['id'];
$data = Pengabdian::find($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role == 'dosen') {
        $dosen_id = $id_dosen;
    } else {
        $dosen_id = $_POST['dosen_id'];
    }

    Pengabdian::update($id, $dosen_id, $_POST['judul_pengabdian'], $_POST['sumber_dana'],
    $_POST['tahun'], $_POST['jumlah_dana']);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Pengalaman Pengabdian berhasil diubah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/pengabdian/view.php?halaman=pengabdian';
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
                                <h3>Ubah Pengalaman Pengabdian</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Ubah Pengalaman Pengabdian
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
                                        <label for="">Dosen Pengabdi</label>
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
                                        <label>Judul Pengabdian</label>
                                        <input type="text" name="judul_pengabdian" class="form-control" value="<?= isset($data['judul_pengabdian']) ? $data['judul_pengabdian'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" class="form-control" value="<?= isset($data['tahun']) ? $data['tahun'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Sumber Dana</label>
                                        <input type="text" name="sumber_dana" class="form-control" value="<?= isset($data['sumber_dana']) ? $data['sumber_dana'] : '' ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jumlah Dana</label>
                                        <input type="number" name="jumlah_dana" class="form-control" value="<?= isset($data['jumlah_dana']) ? $data['jumlah_dana'] : '' ?>" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    <a href="view.php?halaman=pengabdian" class="btn btn-secondary">Kembali</a>
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