<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$title = 'Tambah Publikasi';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Publikasi.php";
include "../../app/models/Dosencontroller.php";
include "../../app/models/Kategori.php";

$dataDosen = Dosen::all();
$dataKategori = Kategori::all();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $dataAnggota = $_POST['penulis_anggota'];
    // $dataKetua = $_POST['ketua_penulis'];
    // foreach ($dataAnggota as $anggota) {
    //     $anggotaExplode = explode('|',$anggota);
    //     $idAnggota = $anggotaExplode[0];
    //     $peranAnggota = $anggotaExplode[2];
    //     print_r($peranAnggota);
    // }
    // print_r($dataKetua);
    // foreach ($dataAnggota as $anggota) {
    //     print_r($anggota);
    // }
    // print_r($_POST);
    $data = [
        'kategori_id' => $_POST['kategori_id'],
        'judul' => $_POST['judul'],
        'jenis_publikasi' => $_POST['jenis_publikasi'],
        'nama_penerbit' => $_POST['nama_penerbit'],
        'tahun_terbit' => $_POST['tahun_terbit'],
        'doi' => $_POST['doi'],
        'link_dokumen' => $_POST['link_dokumen'],
        'deskripsi' => $_POST['deskripsi'],
    ];
    $data2 = [
        'ketua_penulis' => $_POST['ketua_penulis'],
        'penulis_anggota' => $_POST['penulis_anggota'],
    ];
    Publikasi::create($data, $data2);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Publikasi berhasil ditambah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/publikasi/view.php?halaman=publikasi';
    })
    </script>";
}
?>
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
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
                                <h3>Tambah Publikasi</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tambah Publikasi
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="">Kategori Riset</label>
                                        <select name="kategori_id" class="form-control">
                                            <option value="">Pilih Kategori Riset</option>
                                            <?php foreach ($dataKategori as $kategori) { ?>
                                                <option value="<?php echo $kategori['id']; ?>">
                                                    <?php echo $kategori['nama']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Judul</label>
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis</label>
                                        <input type="text" name="jenis_publikasi" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Penerbit</label>
                                        <input type="text" name="nama_penerbit" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>DOI</label>
                                        <input type="text" name="doi" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Link Dokumen</label>
                                        <input type="text" name="link_dokumen" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Ketua Penulis</label>
                                        <select name="ketua_penulis" class="form-control">
                                            <option value="">Pilih Ketua Penulis</option>
                                            <?php foreach ($dataDosen as $dosen) { ?>
                                                <option value="<?php echo $dosen['id']; ?>|1|Ketua Penulis">
                                                    <?php echo $dosen['nama']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Penulis Anggota</label>
                                        <select name="penulis_anggota[]" id="myMultipleSelect" class="form-control" multiple="multiple">
                                            <?php foreach ($dataDosen as $dosen) { ?>
                                                <option value="<?php echo $dosen['id']; ?>|2|Penulis Anggota">
                                                    <?php echo $dosen['nama']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                                    <a href="/PBL-Lab-BA/admin/publikasi/view.php?halaman=publikasi" class="btn btn-secondary">Kembali</a>
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
    <script>
        $(document).ready(function() {
            $('#myMultipleSelect').select2({
                theme: 'bootstrap-5',
                width: 'resolve'
            });
        });
    </script>
    <?php if (!empty($message)) echo $message; ?>
</body>

</html>