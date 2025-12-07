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
include "../../app/controllers/PeminjamanController.php";
$peminjamans = PeminjamanController::fetchAll();
$title = 'Data Peminjaman';
include "../../public/layouts-admin/header-admin.php";
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
                                <h3>Data Peminjaman</h3>
                                <p class="text-subtitle text-muted">
                                    Halaman Tampil Data Peminjaman
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php?halaman=kategori_riset">Peminjaman</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Lihat Data Peminjaman
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Peminjam</th>
                                                <th>Nomor Induk</th>
                                                <th style="width: 25%;">Tanggal Peminjaman</th>
                                                <th>Keperluan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($peminjamans) > 0) : ?>
                                                <?php
                                                $i = 1;
                                                foreach ($peminjamans as $row) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row['nama_peminjam'] ?></td>
                                                        <td><?= $row['no_induk'] ?></td>
                                                        <td>
                                                            <?= tgl_indo($row['tanggal_mulai']) ?> Jam <?= $row['jam_mulai'] ?>
                                                            -
                                                            <?= tgl_indo($row['tanggal_selesai']) ?> Jam <?= $row['jam_selesai'] ?>
                                                        </td>
                                                        <td><?= $row['keperluan'] ?></td>
                                                        <?php if($row['status'] == 'menunggu') : ?>
                                                        <td>
                                                            <a href="ubah-status.php?halaman=peminjaman&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Ganti Status</a>
                                                        </td>
                                                        <?php elseif($row['status'] == 'diterima') : ?>
                                                        <td>
                                                            <span class="btn btn-success btn-sm">Diterima</span>
                                                            <a href="https://api.whatsapp.com/send?phone=<?= $row['no_wa'] ?>&text=Pengajuan%20atas%20nama,%20<?= $row['nama_peminjam'] ?>%20Diterima.%20Terima%20kasih." class="btn btn-success btn-sm" target="_blank">
                                                                <i class="bi bi-whatsapp"></i>
                                                            </a>
                                                        </td>
                                                        <?php elseif($row['status'] == 'ditolak') : ?>
                                                        <td>
                                                            <span class="btn btn-danger btn-sm">Ditolak</span>
                                                            <a href="https://api.whatsapp.com/send?phone=<?= $row['no_wa'] ?>&text=Pengajuan%20atas%20nama,%20<?= $row['nama_peminjam'] ?>%20Ditolak.%20Dengan%20alasan%20<?= $row['alasan_penolakan'] ?>.%20Silakan%20lihat%20lebih%20keterangan%20lebih%20lanjut%20pada%20website%20Lab%20BA.%20Terima%20kasih." class="btn btn-success btn-sm" target="_blank">
                                                                <i class="bi bi-whatsapp"></i>
                                                            </a>
                                                        </td>
                                                        <?php endif ?>
                                                        <td>
                                                            <a class="btn btn-danger btn-sm" href="delete.php?halaman=peminjaman&id=<?= $row['id'] ?>" onclick="return confirm('Hapus data peminjaman ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
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
</body>
