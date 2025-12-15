<?php
include_once "../config/database.php";
global $pdo;
$queryDosen = "SELECT COUNT(*) FROM dosen";
$stmtDosen = $pdo->query($queryDosen);
$countDosen = $stmtDosen->fetchColumn();

$queryPeminjaman = "SELECT COUNT(*) FROM peminjaman WHERE status='menunggu'";
$stmtPeminjaman = $pdo->query($queryPeminjaman);
$countPeminjaman = $stmtPeminjaman->fetchColumn();
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">
                    Halaman Dashboard
                </p>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Total Dosen</h6>
                                    <h6 class="font-extrabold mb-0"><?= $countDosen ?> Orang</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldEdit-Square"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Peminjaman Menunggu Approve</h6>
                                    <h6 class="font-extrabold mb-0"><?= $countPeminjaman ?> Pengajuan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>