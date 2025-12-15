<?php
// =====================
// STATUS MENU
// =====================
$menus = [
    'beranda' => false,
    'kontak' => false,
    'tambah' => false,
    'ubah' => false,
    'kategori_riset' => false,
    'tambah_kategori_riset' => false,
    'ubah_kategori_riset' => false,
    'dosen' => false,
    'tambah_dosen' => false,
    'ubah_dosen' => false,
    'bidang_keahlian' => false,
    'artikel' => false,
    'peminjaman' => false,
    'publikasi' => false,
    'buku' => false,
    'penelitian' => false,
    'pengabdian' => false,
    'perolehan_hki' => false,
    'site_setting' => false,
];

if (isset($_GET['halaman']) && isset($menus[$_GET['halaman']])) {
    $menus[$_GET['halaman']] = true;
}
?>

<!-- =====================
     STYLE SUBMENU
===================== -->
<style>
.sidebar-wrapper .menu .sidebar-item.has-sub .submenu {
    transition: max-height 0.4s ease, opacity 0.4s ease;
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    display: block !important;
}

.sidebar-wrapper .menu .sidebar-item.has-sub.active .submenu {
    max-height: 500px;
    opacity: 1;
}
</style>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <!-- =====================
             HEADER
        ===================== -->
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="/PBL-Lab-BA/admin/index.php?halaman=beranda">
                        <img src="../public/assets/logo/logo.png"
                             onerror="this.onerror=null; this.src='../../public/assets/logo/logo.png';"
                             style="max-width:200px;max-height:80px;">
                    </a>
                </div>

                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- =====================
             MENU
        ===================== -->
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item <?= $menus['beranda'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/index.php?halaman=beranda" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if ($_SESSION['role'] === 'admin'): ?>

                <li class="sidebar-item <?= $menus['peminjaman'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/peminjaman/view.php?halaman=peminjaman" class="sidebar-link">
                        <i class="bi bi-clipboard2-check"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>

                <li class="sidebar-title">Data</li>

                <li class="sidebar-item <?= $menus['kategori_riset'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/kategori_riset/view.php?halaman=kategori_riset" class="sidebar-link">
                        <i class="bi bi-book"></i>
                        <span>Kategori Riset</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $menus['dosen'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/dosen/view.php?halaman=dosen" class="sidebar-link">
                        <i class="bi bi-person-workspace"></i>
                        <span>Dosen</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $menus['bidang_keahlian'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/bidang_keahlian/view.php?halaman=bidang_keahlian" class="sidebar-link">
                        <i class="bi bi-layers"></i>
                        <span>Bidang Keahlian</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $menus['artikel'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/artikel/view.php?halaman=artikel" class="sidebar-link">
                        <i class="bi bi-newspaper"></i>
                        <span>Artikel</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $menus['publikasi'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/publikasi/view.php?halaman=publikasi" class="sidebar-link">
                        <i class="bi bi-filetype-doc"></i>
                        <span>Publikasi</span>
                    </a>
                </li>

                <!-- GALERI -->
                <?php
                $galeriActive =
                    (isset($_GET['halaman']) && $_GET['halaman'] === 'galeri') ||
                    (isset($_GET['kategori']) && in_array($_GET['kategori'], ['aktivitas','fasilitas']));
                ?>

                <li class="sidebar-item has-sub <?= $galeriActive ? 'active' : '' ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-images"></i>
                        <span>Galeri</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item <?= ($_GET['kategori'] ?? '') === 'aktivitas' ? 'active' : '' ?>">
                            <a href="/PBL-Lab-BA/admin/galeri/view.php?kategori=aktivitas">Galeri Aktivitas</a>
                        </li>
                        <li class="submenu-item <?= ($_GET['kategori'] ?? '') === 'fasilitas' ? 'active' : '' ?>">
                            <a href="/PBL-Lab-BA/admin/galeri/view.php?kategori=fasilitas">Galeri Fasilitas</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Pengaturan</li>
                <li class="sidebar-item <?= $menus['site_setting'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/site_setting/edit.php?halaman=site_setting" class="sidebar-link">
                        <i class="bi bi-gear"></i>
                        <span>Site Setting</span>
                    </a>
                </li>

                <?php elseif ($_SESSION['role'] === 'dosen'): ?>

                <li class="sidebar-item <?= $menus['dosen'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/dosen/view.php?halaman=dosen" class="sidebar-link">
                        <i class="bi bi-person-workspace"></i>
                        <span>Dosen</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $menus['penelitian'] ? 'active' : '' ?>">
                    <a href="/PBL-Lab-BA/admin/penelitian/view.php?halaman=penelitian" class="sidebar-link">
                        <i class="bi bi-binoculars-fill"></i>
                        <span>Penelitian</span>
                    </a>
                </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>

<!-- =====================
     JS SUBMENU
===================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidebar-item.has-sub > .sidebar-link')
        .forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                this.parentElement.classList.toggle('active');
            });
        });
});
</script>
