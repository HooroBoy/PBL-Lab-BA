<?php
session_start();
$title = 'Edit Dosen';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Dosencontroller.php"; 
include "../../app/models/BidangKeahlian.php"; 

// --- 1. LOGIKA UTAMA PENGAMBILAN ID ---
// Kita cek apakah ID datang dari URL (GET) saat pertama buka,
// atau dari Form (POST) saat tombol simpan ditekan.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
} else {
    $id = $_GET['id'] ?? null;
}

// Validasi jika ID tidak ada
if (!$id) {
    echo "<script>alert('ID Dosen tidak ditemukan!'); window.location.href='view.php';</script>";
    exit;
}

// Ambil data dosen dari database
$data = Dosen::find($id);
if (!$data) {
    echo "<script>alert('Data tidak ditemukan di database!'); window.location.href='view.php';</script>";
    exit;
}

// --- 2. PERSIAPAN DATA ---

// Ambil data untuk dropdown Bidang Keahlian
$dataBidang = BidangKeahlian::all();

// Ambil data bidang yang sudah dipilih (pastikan array)
$bkSelected = Dosen::bkSelected($id);
if (!is_array($bkSelected)) {
    $bkSelected = [];
}

// Normalisasi data agar tidak error undefined key
$data['foto'] = $data['foto'] ?? '';
$data['metadata'] = $data['metadata'] ?? '{}';
// Pastikan pendidikan/sertifikasi adalah string JSON valid, jika null set array kosong string '[]'
$jsonPendidikan = !empty($data['pendidikan']) ? $data['pendidikan'] : '[]';
$jsonSertifikasi = !empty($data['sertifikasi']) ? $data['sertifikasi'] : '[]';

// Decode ke Array PHP untuk dikirim ke Javascript dengan aman nanti
$arrayPendidikan = json_decode($jsonPendidikan, true) ?? [];
$arraySertifikasi = json_decode($jsonSertifikasi, true) ?? [];


// --- 3. PROSES SIMPAN (UPDATE) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // a. Proses Upload Foto
    $foto = $_POST['foto_lama'] ?? '';
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $targetDir = '../../public/assets/Dosen/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileExt = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $fileName = 'dosen_' . time() . '.' . $fileExt;
        $targetFile = $targetDir . $fileName;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            // Hapus foto lama fisik
            if (!empty($_POST['foto_lama'])) {
                $pathLama = '../../public' . $_POST['foto_lama'];
                if (file_exists($pathLama) && is_file($pathLama)) {
                    unlink($pathLama);
                }
            }
            $foto = '/assets/Dosen/' . $fileName; // Path untuk database
        }
    }

    // b. Siapkan Data Update
    $updateData = [
        'admin_id'          => $_SESSION['user_id'] ?? 0,
        'nip'               => $_POST['nip'],
        'nidn'              => $_POST['nidn'],
        'nama'              => $_POST['nama'],
        'email'             => $_POST['email'],
        'program_studi'     => $_POST['program_studi'],
        'foto'              => $foto,
        'sinta_id'          => $_POST['sinta_id'],
        'google_scholar_id' => $_POST['google_scholar_id'],
        'linkedin_url'      => $_POST['linkedin_url'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'jabatan_fungsional' => $_POST['jabatan_fungsional'],
        'tempat_lahir' => $_POST['tempat_lahir'],
        'tanggal_lahir' => $_POST['tanggal_lahir'],
        'nomor_hp' => $_POST['nomor_hp'],
        'alamat_kantor' => $_POST['alamat_kantor'],
        'nomor_telepon_faks' => $_POST['nomor_telepon_faks'],
        'lulusan_dihasilkan' => $_POST['lulusan_dihasilkan'],
        'mata_kuliah_diampu' => $_POST['mata_kuliah_diampu'],
        'pendidikan'        => $_POST['pendidikan'],  // JSON String dari input hidden
        'sertifikasi'       => $_POST['sertifikasi'], // JSON String dari input hidden
        'metadata'          => $_POST['metadata'] ?? '{}',
    ];

    $bidangData = [
        'bidang_keahlian' => $_POST['bidang_keahlian'] ?? []
    ];

    // c. Eksekusi ke Model
    try {
        Dosen::update($id, $updateData, $bidangData);
        $message = "success";
    } catch (Exception $e) {
        $message = "error";
        $errorMsg = $e->getMessage();
    }
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<body>
    <?php if (isset($message) && $message == 'success'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data Dosen berhasil diperbarui!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'view.php?halaman=dosen';
                });
            });
        </script>
    <?php elseif (isset($message) && $message == 'error'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Error: <?= addslashes($errorMsg) ?>',
                    icon: 'error'
                });
            });
        </script>
    <?php endif; ?>

    <script src="../../public/assets/static/js/initTheme.js"></script>
    
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            
            <div id="main-content">
                <div class="container py-2">
                    <div class="page-heading">
                        <div class="page-title">
                            <h3>Edit Dosen</h3>
                            <p class="text-subtitle text-muted">Halaman Edit Data Dosen</p>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" id="dosenEditForm">
                                    
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="admin_id" value="<?= $_SESSION['user_id'] ?? 0; ?>">

                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Program Studi</label>
                                        <input type="text" name="program_studi" class="form-control" value="<?= htmlspecialchars($data['program_studi'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <input type="text" name="nomor_hp" class="form-control" value="<?= htmlspecialchars($data['nomor_hp'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="<?= htmlspecialchars($data['tempat_lahir'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" value="<?= $data['tanggal_lahir']; ?>" class="form-control" name="tanggal_lahir">
                                    </div>
                                    <div class="mb-3">
                                        <label>NIP</label>
                                        <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($data['nip'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label>NIDN</label>
                                        <input type="text" name="nidn" class="form-control" value="<?= htmlspecialchars($data['nidn'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" id="basic-usage" data-placeholder="Pilih Salah Satu">
                                            <option value="Laki-Laki" <?= $data['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan Fungsional</label>
                                        <input type="text" name="jabatan_fungsional" class="form-control" value="<?= htmlspecialchars($data['jabatan_fungsional'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Kantor</label>
                                        <input type="text" name="alamat_kantor" class="form-control" value="<?= htmlspecialchars($data['alamat_kantor'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon Faks</label>
                                        <input type="text" name="nomor_telepon_faks" class="form-control" value="<?= htmlspecialchars($data['nomor_telepon_faks'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>LinkedIn URL</label>
                                        <input type="text" name="linkedin_url" class="form-control" value="<?= htmlspecialchars($data['linkedin_url'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>SINTA ID</label>
                                        <input type="text" name="sinta_id" class="form-control" value="<?= htmlspecialchars($data['sinta_id'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Google Scholar ID</label>
                                        <input type="text" name="google_scholar_id" class="form-control" value="<?= htmlspecialchars($data['google_scholar_id'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lulusan Dihasilkan</label>
                                        <input type="text" name="lulusan_dihasilkan" class="form-control" value="<?= htmlspecialchars($data['lulusan_dihasilkan'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mata Kuliah yang Diampu</label>
                                        <input type="text" name="mata_kuliah_diampu" class="form-control" value="<?= htmlspecialchars($data['mata_kuliah_diampu'] ?? '') ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label>Foto Dosen</label>
                                        <?php if (!empty($data['foto'])): 
                                            $fotoPath = $data['foto'];
                                            if (strpos($fotoPath, '/assets/Dosen/') !== false) {
                                                $displayFoto = '/PBL-Lab-BA/public' . $fotoPath;
                                            } else {
                                                $displayFoto = '/PBL-Lab-BA/public/assets/Dosen/' . basename($fotoPath);
                                            }
                                        ?>
                                            <div class="mb-2">
                                                <img src="<?= $displayFoto ?>" alt="Foto Dosen" style="max-width:120px;max-height:120px;" class="img-thumbnail">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                        <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($data['foto']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="myMultipleSelect" class="form-label">Bidang Keahlian <span class="text-danger">*</span></label>
                                        <select name="bidang_keahlian[]" id="myMultipleSelect" class="form-control" multiple="multiple">
                                            <?php foreach ($dataBidang as $bidang): ?>
                                                <?php 
                                                    $selected = in_array($bidang['id'], $bkSelected) ? 'selected' : ''; 
                                                ?>
                                                <option value="<?= $bidang['id'] ?>" <?= $selected ?>>
                                                    <?= htmlspecialchars($bidang['nama']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Riwayat Pendidikan</label>
                                        <div id="pendidikan-list"></div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1 add-pendidikan">+ Tambah Pendidikan</button>
                                        <input type="hidden" name="pendidikan" id="pendidikan-json">
                                    </div>

                                    <div class="mb-3">
                                        <label>Sertifikasi / Keahlian</label>
                                        <div id="sertifikasi-list"></div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-1 add-sertifikasi">+ Tambah Sertifikasi</button>
                                        <input type="hidden" name="sertifikasi" id="sertifikasi-json">
                                    </div>

                                    <input type="hidden" name="metadata" value="<?= htmlspecialchars($data['metadata']) ?>">

                                    <div class="mt-4">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        <a href="view.php?halaman=dosen" class="btn btn-secondary ms-2">Kembali</a>
                                    </div>
                                </form>
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

        document.addEventListener('DOMContentLoaded', function () {
            
            // --- DATA DARI PHP KE JS (Menggunakan json_encode agar aman) ---
            const pendidikanData = <?= json_encode($arrayPendidikan) ?>;
            const sertifikasiData = <?= json_encode($arraySertifikasi) ?>;

            const pendidikanList = document.getElementById('pendidikan-list');
            const sertifikasiList = document.getElementById('sertifikasi-list');

            // Render Awal (Menampilkan data yang sudah ada di DB)
            pendidikanData.forEach(item => addPendidikanRow(item));
            sertifikasiData.forEach(item => addSertifikasiRow(item));

            // Fungsi Tambah Row Pendidikan (TAMPILAN ASLI)
            function addPendidikanRow(item = {}) {
                const div = document.createElement('div');
                div.className = 'pendidikan-row row g-2 mb-2';
                div.innerHTML = `
                    <div class="col-md-2"><input type="text" class="form-control item-jenjang" placeholder="Jenjang" value="${item.jenjang || ''}"></div>
                    <div class="col-md-4"><input type="text" class="form-control item-kampus" placeholder="Nama Kampus" value="${item.kampus || ''}"></div>
                    <div class="col-md-3"><input type="text" class="form-control item-jurusan" placeholder="Jurusan" value="${item.jurusan || ''}"></div>
                    <div class="col-md-2"><input type="number" class="form-control item-tahun" placeholder="Thn" value="${item.tahun || ''}"></div>
                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-btn"><strong>x</strong></button></div>
                `;
                pendidikanList.appendChild(div);
            }

            // Fungsi Tambah Row Sertifikasi (TAMPILAN ASLI)
            function addSertifikasiRow(item = {}) {
                const div = document.createElement('div');
                div.className = 'sertifikasi-row row g-2 mb-2';
                div.innerHTML = `
                    <div class="col-md-5"><input type="text" class="form-control item-nama-sertif" placeholder="Nama Sertifikasi" value="${item.nama_sertifikasi || ''}"></div>
                    <div class="col-md-4"><input type="text" class="form-control item-penerbit" placeholder="Penerbit" value="${item.penerbit || ''}"></div>
                    <div class="col-md-2"><input type="number" class="form-control item-tahun-sertif" placeholder="Thn" value="${item.tahun || ''}"></div>
                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-btn"><strong>x</strong></button></div>
                `;
                sertifikasiList.appendChild(div);
            }

            // Event Listeners Tombol Tambah
            document.querySelector('.add-pendidikan').addEventListener('click', () => addPendidikanRow());
            document.querySelector('.add-sertifikasi').addEventListener('click', () => addSertifikasiRow());

            // Event Listener Hapus (Delegation)
            document.body.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-btn') || e.target.closest('.remove-btn')) {
                    const row = e.target.closest('.row'); 
                    if (row) row.remove();
                }
            });

            // --- PROSES SUBMIT FORM ---
            document.getElementById('dosenEditForm').addEventListener('submit', function (e) {
                // Jangan pakai e.preventDefault() agar form terkirim ke PHP

                // 1. Ambil data Pendidikan dari Input dan jadikan JSON
                const pendidikanArr = [];
                document.querySelectorAll('.pendidikan-row').forEach(row => {
                    // Gunakan optional chaining (?.) untuk keamanan
                    const jenjang = row.querySelector('.item-jenjang')?.value.trim() || '';
                    const kampus = row.querySelector('.item-kampus')?.value.trim() || '';
                    const jurusan = row.querySelector('.item-jurusan')?.value.trim() || '';
                    const tahun = row.querySelector('.item-tahun')?.value.trim() || '';
                    
                    // Hanya simpan jika ada isinya
                    if (jenjang || kampus) {
                        pendidikanArr.push({ jenjang, kampus, jurusan, tahun });
                    }
                });
                document.getElementById('pendidikan-json').value = JSON.stringify(pendidikanArr);

                // 2. Ambil data Sertifikasi dari Input dan jadikan JSON
                const sertifikasiArr = [];
                document.querySelectorAll('.sertifikasi-row').forEach(row => {
                    const nama = row.querySelector('.item-nama-sertif')?.value.trim() || '';
                    const penerbit = row.querySelector('.item-penerbit')?.value.trim() || '';
                    const tahun = row.querySelector('.item-tahun-sertif')?.value.trim() || '';
                    
                    if (nama) {
                        sertifikasiArr.push({ nama_sertifikasi: nama, penerbit, tahun });
                    }
                });
                document.getElementById('sertifikasi-json').value = JSON.stringify(sertifikasiArr);
                
                // Form akan lanjut submit secara otomatis...
            });
        });
    </script>
</body>