<?php

if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];
    switch ($halaman) {
        case 'beranda':
            include "dashboard.php";
            break;
        case 'logout':
            include "logout.php";
            break;
        case 'kontak':
            include "contact/view.php";
            break;
        case 'tambah_kontak':
            include "contact/add.php";
            break;
        case 'ubah_kontak':
            include "contact/edit.php";
            break;
        case 'hapus_kontak':
            include "contact/delete.php";
            break;
        case 'kategori_riset':
            include "kategori_riset/view.php";
            break;
        case 'tambah_kategori_riset':
            include "kategori_riset/add.php";
            break;
        case 'ubah_kategori_riset':
            include "kategori_riset/edit.php";
            break;
        case 'hapus_kategori_riset':
            include "kategori_riset/delete.php";
            break;
        case 'dosen':
            include "../admin/dosen/view.php";
            break;
        case 'tambah_dosen':
            include "../admin/dosen/add.php";
            break;
        case 'ubah_dosen':
            include "../admin/dosen/edit.php";
            break;
        case 'hapus_dosen':
            include "../admin/dosen/delete.php";
            break;
        case 'galeri':
            include "../admin/galeri/view.php";
            break;
        case 'tambah_galeri':
            include "../admin/galeri/add.php";
            break;
        case 'ubah_galeri':
            include "../admin/galeri/edit.php";
            break;
        case 'hapus_galeri':
            include "../admin/galeri/delete.php";
            break;
        case 'site_setting':
            include "../admin/site_setting/edit.php";
            break;
        default:
            include "error.php";
    }
} else {
    include "dashboard.php";
}
