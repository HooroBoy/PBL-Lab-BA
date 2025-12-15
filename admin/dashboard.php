<?php

$role = $_SESSION['role'] ?? 'guest';
$dosen_id = $_SESSION['dosen_id'] ?? null;

include_once "../config/database.php";
global $pdo;

$queryDosen = "SELECT COUNT(*) FROM dosen";
$stmtDosen = $pdo->query($queryDosen);
$countDosen = $stmtDosen->fetchColumn();

$queryPeminjaman = "SELECT COUNT(*) FROM peminjaman WHERE status='menunggu'";
$stmtPeminjaman = $pdo->query($queryPeminjaman);
$countPeminjaman = $stmtPeminjaman->fetchColumn();

$stmtBuku = $pdo->prepare("SELECT COUNT(*) FROM karya_buku where dosen_id = ?");
$stmtBuku->execute([$dosen_id]);
$countBuku = $stmtBuku->fetchColumn();

$stmtPenelitian = $pdo->prepare("SELECT COUNT(*) FROM pengalaman_penelitian where dosen_id = ?");
$stmtPenelitian->execute([$dosen_id]);
$countPenelitian = $stmtPenelitian->fetchColumn();

$stmtPengabdian = $pdo->prepare("SELECT COUNT(*) FROM pengalaman_pengabdian where dosen_id = ?");
$stmtPengabdian->execute([$dosen_id]);
$countPengabdian = $stmtPengabdian->fetchColumn();

$stmtHki = $pdo->prepare("SELECT COUNT(*) FROM perolehan_hki where dosen_id = ?");
$stmtHki->execute([$dosen_id]);
$countHki = $stmtHki->fetchColumn();
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
    <?php if($role == 'admin') : ?>
    <section class="row">
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
    </section>
    <?php elseif($role == 'dosen') : ?>
    <section class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Total Karya Buku</h6>
                            <h6 class="font-extrabold mb-0"><?= $countBuku ?> Buku</h6>
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
                            <h6 class="text-muted font-semibold">Total Penelitian</h6>
                            <h6 class="font-extrabold mb-0"><?= $countPenelitian ?> Penelitian</h6>
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
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldPaper-Upload"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Total Pengabdian</h6>
                            <h6 class="font-extrabold mb-0"><?= $countPengabdian ?> Pengabdian</h6>
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
                            <div class="stats-icon mb-2" style="background-color: darkorange;">
                                <i class="iconly-boldSearch"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Total Perolehan HKI</h6>
                            <h6 class="font-extrabold mb-0"><?= $countHki ?> Perolehan HKI</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif ?>
</div>