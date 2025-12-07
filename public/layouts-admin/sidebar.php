<?php

$beranda = false;
$kontak = false;
$tambah = false;
$ubah = false;
$kategori_riset = false;
$tambah_kategori_riset = false;
$ubah_kategori_riset = false;
$dosen = false;
$tambah_dosen = false;
$ubah_dosen = false;
$bidang_keahlian = false;
$artikel = false;
$peminjaman = false;
$publikasi = false;
$site_setting = false;


if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];
    switch ($halaman) {
        case 'beranda':
            $beranda = true;
            break;
        case 'kontak':
            $kontak = true;
            break;
        case 'tambah_kontak':
            $tambah = true;
            break;
        case 'ubah_kontak':
            $ubah = true;
            break;
        case 'kategori_riset':
            $kategori_riset = true;
            break;
        case 'tambah_kategori_riset':
            $tambah_kategori_riset = true;
            break;
        case 'ubah_kategori_riset':
            $ubah_kategori_riset = true;
            break;
        case 'dosen':
            $dosen = true;
            break;
        case 'tambah_dosen':
            $tambah_dosen = true;
            break;
        case 'ubah_dosen':
            $ubah_dosen = true;
            break;
        case 'bidang_keahlian':
            $bidang_keahlian = true;
            break;
        case 'artikel':
            $artikel = true;
            break;
        case 'peminjaman':
            $peminjaman = true;
            break;
        case 'publikasi':
            $publikasi = true;
            break;
        case 'site_setting':
            $site_setting = true;
            break;
        default:
            $beranda = false;
            $kontak = false;
            $tambah = false;
            $ubah = false;
            $kategori_riset = false;
            $tambah_kategori_riset = false;
            $ubah_kategori_riset = false;
            $dosen = false;
            $tambah_dosen = false;
            $ubah_dosen = false;
            $bidang_keahlian = false;
            $tambah_bidang_keahlian = false;
            $ubah_bidang_keahlian = false;
            $artikel = false;
            $peminjaman = false;
            $publikasi = false;
            $site_setting = false;
    }
} else {
    $beranda = false;
    $kontak = false;
    $tambah = false;
    $ubah = false;
    $kategori_riset = false;
    $tambah_kategori_riset = false;
    $ubah_kategori_riset = false;
    $site_setting = false;
}

?>

<style>
    /* Transisi halus untuk submenu */
    .sidebar-wrapper .menu .sidebar-item.has-sub .submenu {
        transition: max-height 0.5s ease-out, opacity 0.5s ease-out;
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        display: block !important;
        /* Override default display:none */
    }

    /* Ketika class active ditambahkan (biasanya oleh JS template Mazer) */
    .sidebar-wrapper .menu .sidebar-item.has-sub.active .submenu {
        max-height: 500px;
        /* Nilai secukupnya */
        opacity: 1;
    }
</style>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="index.php?halaman=beranda">
                        <img src="../public/assets/compiled/svg/logo.svg"
                            onerror="this.onerror=null; this.src='../../public/assets/compiled/svg/logo.svg';"
                            alt="Deskripsi gambar">
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <!-- ...existing code... -->
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <script>
            // Dropdown galeri sidebar
            document.addEventListener('DOMContentLoaded', function () {
                var galeriItem = document.querySelector('.sidebar-item.has-sub');
                if (galeriItem) {
                    galeriItem.addEventListener('click', function (e) {
                        // Toggle active class
                        if (e.target.closest('.sidebar-link')) {
                            galeriItem.classList.toggle('active');
                            e.preventDefault();
                        }
                    });
                }
            });
        </script>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item <?= $beranda ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/index.php?halaman=beranda" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $peminjaman ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/peminjaman/view.php?halaman=peminjaman" class="sidebar-link">
                        <i class="bi bi-clipboard2-check"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>


                <li class="sidebar-title">Pengaturan</li>

                <li
                    class="sidebar-item <?= $kategori_riset || $tambah_kategori_riset || $ubah_kategori_riset ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/kategori_riset/view.php?halaman=kategori_riset" class="sidebar-link">
                        <i class="bi bi-book"></i>
                        <span>Kategori Riset</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $dosen || $tambah_dosen || $ubah_dosen ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/dosen/view.php?halaman=dosen" class="sidebar-link">
                        <i class="bi bi-person-workspace"></i>
                        <span>Dosen</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $bidang_keahlian ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/bidang_keahlian/view.php?halaman=bidang_keahlian" class="sidebar-link">
                        <i class="bi bi-layers"></i>
                        <span>Bidang Keahlian</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $artikel ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/artikel/view.php?halaman=artikel" class="sidebar-link">
                        <i class="bi bi-newspaper"></i>
                        <span>Artikel</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $publikasi ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/publikasi/view.php?halaman=publikasi" class="sidebar-link">
                        <i class="bi bi-filetype-doc"></i>
                        <span>Publikasi</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub
                <?php
                $galeriActive = false;
                if (isset($_GET['halaman']) && $_GET['halaman'] == 'galeri')
                    $galeriActive = true;
                if (isset($_GET['kategori']) && ($_GET['kategori'] == 'aktivitas' || $_GET['kategori'] == 'fasilitas'))
                    $galeriActive = true;
                if ($galeriActive)
                    echo 'active';
                ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-images"></i>
                        <span>Galeri</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item <?php if (isset($_GET['kategori']) && $_GET['kategori'] == 'aktivitas')
                                echo 'active'; ?>">
                            <a href="/PBL-Lab-BA/admin/galeri/view.php?kategori=aktivitas">Galeri Aktivitas</a>
                        </li>
                        <li
                            class="submenu-item <?php if (isset($_GET['kategori']) && $_GET['kategori'] == 'fasilitas')
                                echo 'active'; ?>">
                            <a href="/PBL-Lab-BA/admin/galeri/view.php?kategori=fasilitas">Galeri Fasilitas</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?= $site_setting ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/site_setting/edit.php?halaman=site_setting" class="sidebar-link">
                        <i class="bi bi-gear"></i>
                        <span>Site Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>