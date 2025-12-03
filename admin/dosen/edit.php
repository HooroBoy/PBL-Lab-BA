session_start();
$title = 'Edit Dosen';
include "../../public/layouts-admin/header-admin.php";
include "../../app/models/Dosen.php";

$id = $_GET['id'];
$data = Dosen::find($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateData = [
        'admin_id' => $_POST['admin_id'],
        'nip' => $_POST['nip'],
        'nidn' => $_POST['nidn'],
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'program_studi' => $_POST['program_studi'],
        'foto' => $_POST['foto'],
        'sinta_id' => $_POST['sinta_id'],
        'google_scholar_id' => $_POST['google_scholar_id'],
        'linkedin_url' => $_POST['linkedin_url'],
        'pendidikan' => $_POST['pendidikan'],
        'sertifikasi' => $_POST['sertifikasi'],
        'metadata' => $_POST['metadata'],
    ];
    Dosen::update($id, $updateData);
    $message = "<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Dosen berhasil diubah!',
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
                <form method="post">
                    <div class="mb-3">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value="<?= isset($data['nip']) ? $data['nip'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="view.php?halaman=dosen" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
include "./function/connection.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;
$data = [];
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM kategori_riset WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $sql = "UPDATE kategori_riset SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([':nama' => $nama, ':deskripsi' => $deskripsi, ':id' => $id]);
    if ($result) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil',
            text: 'Kategori berhasil diupdate!',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = 'index.php?halaman=kategori_riset';
        })
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Gagal update kategori!',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })
        </script>";
    }
}
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ubah Kategori Riset</h3>
                <p class="text-subtitle text-muted">
                    Halaman Ubah Kategori Riset
                </p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" value="<?= isset($data['deskripsi']) ? $data['deskripsi'] : '' ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="index.php?halaman=kategori_riset" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>