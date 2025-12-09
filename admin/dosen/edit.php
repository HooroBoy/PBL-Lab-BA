<?php
session_start();
$title = 'Edit Dosen';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Dosencontroller.php"; // Pastikan include model yang benar
include "../../app/models/BidangKeahlian.php"; // Include Model Bidang Keahlian

$id = $_GET['id'];
$data = Dosen::find($id);

// 1. Ambil data untuk dropdown Bidang Keahlian
$dataBidang = BidangKeahlian::all();
// 2. Ambil data bidang yang sudah dipilih dosen ini (array of IDs)
$bkSelected = Dosen::bkSelected($id);

// Pastikan key yang digunakan selalu ada
if (!isset($data['foto'])) $data['foto'] = '';
if (!isset($data['metadata'])) $data['metadata'] = '{}';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses upload foto jika ada file baru
    $foto = isset($_POST['foto_lama']) ? $_POST['foto_lama'] : '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $targetDir = '../../public/assets/Dosen/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES['foto']['name']);
        $targetFile = $targetDir . time() . '_' . $fileName;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            $foto = str_replace('../../public', '', $targetFile); // Simpan path relatif dari /public
        }
    }

    $updateData = [
        'admin_id' => $_POST['admin_id'],
        'nip' => $_POST['nip'],
        'nidn' => $_POST['nidn'],
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'program_studi' => $_POST['program_studi'],
        'foto' => $foto,
        'sinta_id' => $_POST['sinta_id'],
        'google_scholar_id' => $_POST['google_scholar_id'],
        'linkedin_url' => $_POST['linkedin_url'],
        'pendidikan' => $_POST['pendidikan'],
        'sertifikasi' => $_POST['sertifikasi'],
        'metadata' => isset($_POST['metadata']) ? $_POST['metadata'] : '{}',
    ];

    // 3. Siapkan data Bidang Keahlian untuk dikirim ke Model Update
    $bidangData = [
        'bidang_keahlian' => isset($_POST['bidang_keahlian']) ? $_POST['bidang_keahlian'] : []
    ];

    // 4. Panggil fungsi update dengan parameter ke-3
    Dosen::update($id, $updateData, $bidangData);

    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Dosen berhasil diupdate!',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/dosen/view.php?halaman=dosen';
    });
    </script>";
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<body>
    <?php if (isset($message)) echo $message; ?>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            <div id="main-content">
                <div class="container py-2">
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Edit Dosen</h3>
                                    <p class="text-subtitle text-muted">
                                        Halaman Edit Dosen
                                    </p>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" id="dosenEditForm">
                                        <input type="hidden" name="admin_id" value="<?= $_SESSION['id']; ?>">
                                        
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Program Studi</label>
                                            <input type="text" name="program_studi" class="form-control" value="<?= isset($data['program_studi']) ? $data['program_studi'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>LinkedIn URL</label>
                                            <input type="text" name="linkedin_url" class="form-control" value="<?= isset($data['linkedin_url']) ? $data['linkedin_url'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>NIP</label>
                                            <input type="text" name="nip" class="form-control" value="<?= isset($data['nip']) ? $data['nip'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>NIDN</label>
                                            <input type="text" name="nidn" class="form-control" value="<?= isset($data['nidn']) ? $data['nidn'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>SINTA ID</label>
                                            <input type="text" name="sinta_id" class="form-control" value="<?= isset($data['sinta_id']) ? $data['sinta_id'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Google Scholar ID</label>
                                            <input type="text" name="google_scholar_id" class="form-control" value="<?= isset($data['google_scholar_id']) ? $data['google_scholar_id'] : '' ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Foto Dosen</label>
                                            <?php if (!empty($data['foto'])): ?>
                                                <div class="mb-2">
                                                    <?php
                                                        $fotoPath = $data['foto'];
                                                        if (strpos($fotoPath, '/assets/Dosen/') !== false) {
                                                            $fotoPath = '/PBL-Lab-BA/public' . $fotoPath;
                                                        } elseif (file_exists('../../public/assets/Dosen/' . basename($fotoPath))) {
                                                            $fotoPath = '/PBL-Lab-BA/public/assets/Dosen/' . basename($fotoPath);
                                                        }
                                                    ?>
                                                    <img src="<?= $fotoPath ?>" alt="Foto Dosen" style="max-width:120px;max-height:120px;">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" name="foto" class="form-control" accept="image/*">
                                            <input type="hidden" name="foto_lama" value="<?= isset($data['foto']) ? $data['foto'] : '' ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="myMultipleSelect" class="form-label">Bidang Keahlian <span class="text-danger">*</span></label>
                                            <select name="bidang_keahlian[]" id="myMultipleSelect" class="form-control" multiple="multiple">
                                                <?php foreach ($dataBidang as $bidang) { ?>
                                                    <?php 
                                                        // Cek apakah ID bidang ini ada di array $bkSelected
                                                        $isSelected = in_array($bidang['id'], $bkSelected) ? 'selected' : ''; 
                                                    ?>
                                                    <option value="<?php echo $bidang['id']; ?>" <?php echo $isSelected; ?>>
                                                        <?php echo $bidang['nama']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Riwayat Pendidikan</label>
                                            <div id="pendidikan-list">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-primary mt-1 add-pendidikan">+ Tambah Pendidikan</button>
                                            <input type="hidden" name="pendidikan" id="pendidikan-json">
                                        </div>
                                        <div class="mb-3">
                                            <label>Sertifikasi / Keahlian</label>
                                            <div id="sertifikasi-list">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-primary mt-1 add-sertifikasi">+ Tambah Sertifikasi</button>
                                            <input type="hidden" name="sertifikasi" id="sertifikasi-json">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        <a href="view.php?halaman=dosen" class="btn btn-secondary ms-2">Kembali</a>
                                    </form>
                                    <script>
                                    // Inisialisasi data pendidikan dan sertifikasi dari PHP
                                    document.addEventListener('DOMContentLoaded', function () {
                                        // Pendidikan
                                        let pendidikanData = [];
                                        try { pendidikanData = JSON.parse('<?= isset($data['pendidikan']) ? addslashes($data['pendidikan']) : '[]' ?>'); } catch(e) { pendidikanData = []; }
                                        const pendidikanList = document.getElementById('pendidikan-list');
                                        pendidikanData.forEach(function(item) {
                                            const div = document.createElement('div');
                                            div.className = 'pendidikan-row row g-2 mb-2';
                                            div.innerHTML = `
                                                <div class="col-md-2"><input type="text" class="form-control item-jenjang" placeholder="Jenjang" value="${item.jenjang || ''}"></div>
                                                <div class="col-md-4"><input type="text" class="form-control item-kampus" placeholder="Nama Kampus" value="${item.kampus || ''}"></div>
                                                <div class="col-md-3"><input type="text" class="form-control item-jurusan" placeholder="Jurusan" value="${item.jurusan || ''}"></div>
                                                <div class="col-md-2"><input type="number" class="form-control item-tahun" placeholder="Thn" value="${item.tahun || ''}"></div>
                                                <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-pendidikan"><strong>x</strong></button></div>
                                            `;
                                            pendidikanList.appendChild(div);
                                        });
                                        // Sertifikasi
                                        let sertifikasiData = [];
                                        try { sertifikasiData = JSON.parse('<?= isset($data['sertifikasi']) ? addslashes($data['sertifikasi']) : '[]' ?>'); } catch(e) { sertifikasiData = []; }
                                        const sertifikasiList = document.getElementById('sertifikasi-list');
                                        sertifikasiData.forEach(function(item) {
                                            const div = document.createElement('div');
                                            div.className = 'sertifikasi-row row g-2 mb-2';
                                            div.innerHTML = `
                                                <div class="col-md-5"><input type="text" class="form-control item-nama-sertif" placeholder="Nama Sertifikasi" value="${item.nama_sertifikasi || ''}"></div>
                                                <div class="col-md-4"><input type="text" class="form-control item-penerbit" placeholder="Penerbit" value="${item.penerbit || ''}"></div>
                                                <div class="col-md-2"><input type="number" class="form-control item-tahun-sertif" placeholder="Thn" value="${item.tahun || ''}"></div>
                                                <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-sertifikasi"><strong>x</strong></button></div>
                                            `;
                                            sertifikasiList.appendChild(div);
                                        });
                                        // Event delegation untuk tambah/hapus baris
                                        document.body.addEventListener('click', function (e) {
                                            if (e.target.classList.contains('add-pendidikan')) {
                                                const div = document.createElement('div');
                                                div.className = 'pendidikan-row row g-2 mb-2';
                                                div.innerHTML = `
                                                    <div class="col-md-2"><input type="text" class="form-control item-jenjang" placeholder="Jenjang"></div>
                                                    <div class="col-md-4"><input type="text" class="form-control item-kampus" placeholder="Nama Kampus"></div>
                                                    <div class="col-md-3"><input type="text" class="form-control item-jurusan" placeholder="Jurusan"></div>
                                                    <div class="col-md-2"><input type="number" class="form-control item-tahun" placeholder="Thn"></div>
                                                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-pendidikan"><strong>x</strong></button></div>
                                                `;
                                                pendidikanList.appendChild(div);
                                            }
                                            if (e.target.classList.contains('remove-pendidikan') || e.target.closest('.remove-pendidikan')) {
                                                const row = e.target.closest('.pendidikan-row');
                                                if (row) row.remove();
                                            }
                                            if (e.target.classList.contains('add-sertifikasi')) {
                                                const div = document.createElement('div');
                                                div.className = 'sertifikasi-row row g-2 mb-2';
                                                div.innerHTML = `
                                                    <div class="col-md-5"><input type="text" class="form-control item-nama-sertif" placeholder="Nama Sertifikasi"></div>
                                                    <div class="col-md-4"><input type="text" class="form-control item-penerbit" placeholder="Penerbit"></div>
                                                    <div class="col-md-2"><input type="number" class="form-control item-tahun-sertif" placeholder="Thn"></div>
                                                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-sertifikasi"><strong>x</strong></button></div>
                                                `;
                                                sertifikasiList.appendChild(div);
                                            }
                                            if (e.target.classList.contains('remove-sertifikasi') || e.target.closest('.remove-sertifikasi')) {
                                                const row = e.target.closest('.sertifikasi-row');
                                                if (row) row.remove();
                                            }
                                        });
                                        // Submit form: konversi ke JSON
                                        document.getElementById('dosenEditForm').addEventListener('submit', function (e) {
                                            // Pendidikan
                                            const pendidikanArr = [];
                                            document.querySelectorAll('.pendidikan-row').forEach(row => {
                                                const jenjang = row.querySelector('.item-jenjang').value;
                                                const kampus = row.querySelector('.item-kampus').value;
                                                const jurusan = row.querySelector('.item-jurusan').value;
                                                const tahun = row.querySelector('.item-tahun').value;
                                                if (jenjang && kampus) {
                                                    pendidikanArr.push({ jenjang, kampus, jurusan, tahun });
                                                }
                                            });
                                            document.getElementById('pendidikan-json').value = pendidikanArr.length ? JSON.stringify(pendidikanArr) : '[]';
                                            // Sertifikasi
                                            const sertifikasiArr = [];
                                            document.querySelectorAll('.sertifikasi-row').forEach(row => {
                                                const nama = row.querySelector('.item-nama-sertif').value;
                                                const penerbit = row.querySelector('.item-penerbit').value;
                                                const tahun = row.querySelector('.item-tahun-sertif').value;
                                                if (nama) {
                                                    sertifikasiArr.push({ nama_sertifikasi: nama, penerbit, tahun });
                                                }
                                            });
                                            document.getElementById('sertifikasi-json').value = sertifikasiArr.length ? JSON.stringify(sertifikasiArr) : '[]';
                                        });
                                    });
                                    </script>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php require("../../public/layouts-admin/footer.php") ?>
            </div>
        </div>
        <script src="../../public/assets/static/js/components/dark.js"></script>
        <script src="../../public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../../public/assets/compiled/js/app.js"></script>
        <script src="../../public/assets/static/js/pages/sweetalert2.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#myMultipleSelect').select2({
                    theme: 'bootstrap-5',
                    width: 'resolve',
                    placeholder: 'Pilih Bidang Keahlian'
                });
            });
        </script>
    </div>
</body>
</html>