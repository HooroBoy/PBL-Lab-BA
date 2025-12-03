<?php
session_start();
$title = 'Tambah Dosen';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Dosen.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $targetDir = '../../uploads/';
        $fileName = basename($_FILES['foto']['name']);
        $targetFile = $targetDir . time() . '_' . $fileName;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            $foto = str_replace('../../', '/', $targetFile); // Simpan path relatif
        }
    }
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
        'pendidikan' => $_POST['pendidikan'],
        'sertifikasi' => $_POST['sertifikasi'],
        'metadata' => $_POST['metadata'],
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
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama <span class="text-danger">*</span></label>
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
                                        <div class="mb-3">
                                            <label class="form-label">Admin ID</label>
                                            <input type="number" name="admin_id" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pendidikan</label>
                                            <div id="pendidikan-list">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control pendidikan-item" placeholder="Masukkan pendidikan">
                                                    <button type="button" class="btn btn-outline-primary add-pendidikan"><strong>+</strong></button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="pendidikan" id="pendidikan-json">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sertifikasi</label>
                                            <div id="sertifikasi-list">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control sertifikasi-item" placeholder="Masukkan sertifikasi">
                                                    <button type="button" class="btn btn-outline-primary add-sertifikasi"><strong>+</strong></button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="sertifikasi" id="sertifikasi-json">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Metadata (JSON)</label>
                                            <input type="text" name="metadata" class="form-control" value="{}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Photo <span class="text-danger">*</span></label>
                                                <input type="file" name="foto" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary">Tambah Dosen</button>
                                            <a href="view.php?halaman=dosen" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                    <script>
                                    // Pendidikan
                                    document.addEventListener('click', function(e) {
                                        if (e.target.classList.contains('add-pendidikan')) {
                                            const list = document.getElementById('pendidikan-list');
                                            const div = document.createElement('div');
                                            div.className = 'input-group mb-2';
                                            div.innerHTML = `<input type="text" class="form-control pendidikan-item" placeholder="Masukkan pendidikan"><button type="button" class="btn btn-outline-danger remove-pendidikan"><strong>-</strong></button>`;
                                            list.appendChild(div);
                                        }
                                        if (e.target.classList.contains('remove-pendidikan')) {
                                            e.target.parentElement.remove();
                                        }
                                        if (e.target.classList.contains('add-sertifikasi')) {
                                            const list = document.getElementById('sertifikasi-list');
                                            const div = document.createElement('div');
                                            div.className = 'input-group mb-2';
                                            div.innerHTML = `<input type="text" class="form-control sertifikasi-item" placeholder="Masukkan sertifikasi"><button type="button" class="btn btn-outline-danger remove-sertifikasi"><strong>-</strong></button>`;
                                            list.appendChild(div);
                                        }
                                        if (e.target.classList.contains('remove-sertifikasi')) {
                                            e.target.parentElement.remove();
                                        }
                                    });
                                    document.getElementById('dosenForm').addEventListener('submit', function(e) {
                                        // Pendidikan
                                        const pendidikanArr = Array.from(document.querySelectorAll('.pendidikan-item')).map(i => i.value).filter(i => i);
                                        document.getElementById('pendidikan-json').value = JSON.stringify(pendidikanArr);
                                        // Sertifikasi
                                        const sertifikasiArr = Array.from(document.querySelectorAll('.sertifikasi-item')).map(i => i.value).filter(i => i);
                                        document.getElementById('sertifikasi-json').value = JSON.stringify(sertifikasiArr);
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
</body>

</html>