<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
session_start();
$title = 'Ganti Status Pengajuan Peminjaman';
include "../../public/layouts-admin/header-admin.php";
include "../../app/controllers/PeminjamanController.php";

$id = $_GET['id'];
$data = PeminjamanController::find($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    if ($_POST['alasan']) {
        $alasan = $_POST['alasan'];
    } else {
        $alasan = '-';
    }
    PeminjamanController::SetStatus($id, $status, $alasan);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Status pengajuan peminjaman berhasil diubah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/peminjaman/view.php?halaman=peminjaman';
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
                                <h3>Ganti Status Pengajuan Peminjaman</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Ganti Status Pengajuan Peminjaman
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="mb-3 fw-bold" style="font-size: large;">
                                    <tr>
                                        <td>Nama Peminjam</td>
                                        <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                                        <td><?= $data['nama_peminjam'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Induk</td>
                                        <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                                        <td><?= $data['no_induk'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Peminjaman</td>
                                        <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                                        <td><?= tgl_indo($data['tanggal_mulai']) ?> Jam <?= $data['jam_mulai'] ?> - <?= tgl_indo($data['tanggal_selesai']) ?> Jam <?= $data['jam_selesai'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keperluan</td>
                                        <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                                        <td><?= $data['keperluan'] ?></td>
                                    </tr>
                                </table>
                                <form method="post">
                                    <div class="mb-3">
                                        <label>Status Pengajuan</label>
                                        <select name="status" id="status" class="form-control" onchange="otherSelect()">
                                            <option value="diterima">Diterima</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="boxAlasan" style="visibility: hidden;">
                                        <label for="">Alasan Penolakan</label>
                                        <input name="alasan" type="text" class="form-control"/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Ganti Status</button>
                                    <a href="view.php?halaman=peminjaman" class="btn btn-secondary">Kembali</a>
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
    <script>
        function otherSelect() {
            var other = document.getElementById("boxAlasan");
            if (document.forms[0].status.options[document.forms[0].status.selectedIndex].value == "ditolak") {
                other.style.visibility = "visible";
            }
            else {
                other.style.visibility = "hidden";
            }
        }
    </script>
</body>

</html>