<?php
session_start();
$title = 'Tambah Dosen';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Dosencontroller.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto = '';
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
    // Pastikan input JSON tidak null, jika kosong set sebagai array JSON kosong '[]'
    $pendidikanInput = !empty($_POST['pendidikan']) ? $_POST['pendidikan'] : '[]';
    $sertifikasiInput = !empty($_POST['sertifikasi']) ? $_POST['sertifikasi'] : '[]';
    $metadataInput = !empty($_POST['metadata']) ? $_POST['metadata'] : '{}';

    $data = [
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

        // Gunakan variabel yang sudah divalidasi
        'pendidikan' => $pendidikanInput,
        'sertifikasi' => $sertifikasiInput,
        'metadata' => $metadataInput,
    ];

    Dosen::create($data);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Dosen berhasil ditambah!',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    }).then(() => {
        window.location.href = '/PBL-Lab-BA/admin/dosen/view.php?halaman=dosen';
    })
    </script>";
}
?>

<body>
    <script src="../../public/assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php require("../../public/layouts-admin/sidebar.php") ?>
        <div id="main" class="layout-navbar navbar-fixed">
            <?php require("../../public/layouts-admin/header.php") ?>
            <div id="main-content">
                <div class="container py-2">
                    <div class="page-heading mb-2">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3 class="mb-1">Tambah Dosen</h3>
                                    <p class="text-subtitle text-muted mb-1">Halaman Tambah Dosen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm mb-4 w-100">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" id="dosenForm">
                                        <div class="mb-3">
                                            <label class="form-label">Foto Dosen</label>
                                            <input type="file" name="foto" class="form-control" accept="image/*">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Program Studi</label>
                                                <input type="text" name="program_studi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">LinkedIn URL</label>
                                                <input type="text" name="linkedin_url" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">NIP</label>
                                                <input type="text" name="nip" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">NIDN</label>
                                                <input type="text" name="nidn" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">SINTA ID</label>
                                                <input type="text" name="sinta_id" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Google Scholar ID</label>
                                                <input type="text" name="google_scholar_id" class="form-control">
                                            </div>
                                        </div>
                                            <input type="hidden" name="admin_id" class="form-control" value="<?php echo $_SESSION['id']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Riwayat Pendidikan</label>
                                            <div id="pendidikan-list">
                                                <div class="pendidikan-row row g-2 mb-2">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control item-jenjang"
                                                            placeholder="Jenjang (S1/S2)">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control item-kampus"
                                                            placeholder="Nama Kampus">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control item-jurusan"
                                                            placeholder="Jurusan">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" class="form-control item-tahun"
                                                            placeholder="Thn Lulus">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button"
                                                            class="btn btn-outline-danger w-100 remove-pendidikan"><strong>x</strong></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-primary mt-1 add-pendidikan">+ Tambah
                                                Pendidikan</button>

                                            <input type="hidden" name="pendidikan" id="pendidikan-json">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Sertifikasi / Keahlian</label>
                                            <div id="sertifikasi-list">
                                                <div class="sertifikasi-row row g-2 mb-2">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control item-nama-sertif" placeholder="Nama Sertifikasi">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control item-penerbit" placeholder="Penerbit / Organisasi">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" class="form-control item-tahun-sertif" placeholder="Tahun">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-outline-danger w-100 remove-sertifikasi"><strong>x</strong></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-primary mt-1 add-sertifikasi">+ Tambah Sertifikasi</button>
                                            <input type="hidden" name="sertifikasi" id="sertifikasi-json">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                                            <a href="view.php?halaman=dosen" class="btn btn-secondary ms-2">Kembali</a>
                                        </div>
                                    </form>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {

                                            // --- 1. Logic Tambah/Hapus Baris (Event Delegation) ---
                                            document.body.addEventListener('click', function (e) {

                                                // Tambah Pendidikan
                                                if (e.target.classList.contains('add-pendidikan')) {
                                                    const list = document.getElementById('pendidikan-list');
                                                    const div = document.createElement('div');
                                                    div.className = 'pendidikan-row row g-2 mb-2';
                                                    div.innerHTML = `
                <div class="col-md-2"><input type="text" class="form-control item-jenjang" placeholder="Jenjang"></div>
                <div class="col-md-4"><input type="text" class="form-control item-kampus" placeholder="Nama Kampus"></div>
                <div class="col-md-3"><input type="text" class="form-control item-jurusan" placeholder="Jurusan"></div>
                <div class="col-md-2"><input type="number" class="form-control item-tahun" placeholder="Thn"></div>
                <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-pendidikan"><strong>x</strong></button></div>
            `;
                                                    list.appendChild(div);
                                                }

                                                // Hapus Pendidikan
                                                if (e.target.classList.contains('remove-pendidikan') || e.target.closest('.remove-pendidikan')) {
                                                    const row = e.target.closest('.pendidikan-row');
                                                    if (row) row.remove();
                                                }

                                                // Tambah Sertifikasi
                                                if (e.target.classList.contains('add-sertifikasi')) {
                                                    const list = document.getElementById('sertifikasi-list');
                                                    const div = document.createElement('div');
                                                    div.className = 'sertifikasi-row row g-2 mb-2';
                                                    div.innerHTML = `
                <div class="col-md-5"><input type="text" class="form-control item-nama-sertif" placeholder="Nama Sertifikasi"></div>
                <div class="col-md-4"><input type="text" class="form-control item-penerbit" placeholder="Penerbit"></div>
                <div class="col-md-2"><input type="number" class="form-control item-tahun-sertif" placeholder="Thn"></div>
                <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-sertifikasi"><strong>x</strong></button></div>
            `;
                                                    list.appendChild(div);
                                                }

                                                // Hapus Sertifikasi
                                                if (e.target.classList.contains('remove-sertifikasi') || e.target.closest('.remove-sertifikasi')) {
                                                    const row = e.target.closest('.sertifikasi-row');
                                                    if (row) row.remove();
                                                }
                                            });

                                            // --- 2. Logic Submit Form (Convert ke JSON) ---
                                            document.getElementById('dosenForm').addEventListener('submit', function (e) {

                                                // A. Proses Pendidikan
                                                const pendidikanArr = [];
                                                document.querySelectorAll('.pendidikan-row').forEach(row => {
                                                    const jenjang = row.querySelector('.item-jenjang').value;
                                                    const kampus = row.querySelector('.item-kampus').value;
                                                    const jurusan = row.querySelector('.item-jurusan').value;
                                                    const tahun = row.querySelector('.item-tahun').value;

                                                    // Validasi: Hanya masukkan jika minimal Jenjang & Kampus terisi
                                                    if (jenjang && kampus) {
                                                        pendidikanArr.push({
                                                            jenjang: jenjang,
                                                            kampus: kampus,
                                                            jurusan: jurusan,
                                                            tahun: tahun
                                                        });
                                                    }
                                                });
                                                // Jika kosong kirim '[]' agar tidak error di JSON decode
                                                document.getElementById('pendidikan-json').value = pendidikanArr.length ? JSON.stringify(pendidikanArr) : '[]';


                                                // B. Proses Sertifikasi
                                                const sertifikasiArr = [];
                                                document.querySelectorAll('.sertifikasi-row').forEach(row => {
                                                    const nama = row.querySelector('.item-nama-sertif').value;
                                                    const penerbit = row.querySelector('.item-penerbit').value;
                                                    const tahun = row.querySelector('.item-tahun-sertif').value;

                                                    if (nama) {
                                                        sertifikasiArr.push({
                                                            nama_sertifikasi: nama,
                                                            penerbit: penerbit,
                                                            tahun: tahun
                                                        });
                                                    }
                                                });
                                                document.getElementById('sertifikasi-json').value = sertifikasiArr.length ? JSON.stringify(sertifikasiArr) : '[]';
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require("../../public/layouts-admin/footer.php") ?>
        </div>
    </div>
    <script src="../../public/assets/static/js/components/dark.js"></script>
    <script src="../../public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../public/assets/compiled/js/app.js"></script>
    <script src="../../public/assets/static/js/pages/sweetalert2.js"></script>
    
    <?=$message ?>
</body>

</html>