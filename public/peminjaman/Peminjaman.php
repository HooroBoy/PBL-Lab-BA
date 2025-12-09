<?php
$page_title = "Peminjaman Alat & Ruang Laboratory of Business Analytics";

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahan 0 = tanggal
	// variabel pecahan 1 = bulan
	// variabel pecahan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<?php
$page_title = 'Peminjaman Alat & Ruang';
require_once '../../app/controllers/PeminjamanController.php';
$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
  $no_induk = isset($_POST['no_induk']) ? trim($_POST['no_induk']) : '';
  $tanggal_mulai = $_POST['tanggal_mulai'] ?? '';
  $tanggal_selesai = $_POST['tanggal_selesai'] ?? '';
  $jam_mulai = $_POST['mulai'] ?? '';
  $jam_selesai = $_POST['selesai'] ?? '';
  $keperluan = $_POST['keperluan'];
  $no_wa = $_POST['no_wa'];
  
  // Panggil controller
  $result = PeminjamanController::insertJadwal(
    $nama,
    $no_induk,
    $tanggal_mulai,
    $tanggal_selesai,
    $jam_mulai,
    $jam_selesai,
    $keperluan,
    $no_wa
  );

  if ($result['type'] != 'success') {
    $_SESSION['alerts'] = $result;
    $_POST = array(); 
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  } else {
    $_SESSION['alerts'] = $result;
    $_POST = array(); 
    header('Location: https://api.whatsapp.com/send?phone=6285183192045&text=Halo%20Admin,%20saya%20'.$nama.'%20ingin%20melakukan%20peminjaman%20pada%20tanggal%20'.tgl_indo($tanggal_mulai).'%20s.d%20tanggal%20'.tgl_indo($tanggal_selesai).'%20untuk%20'.$keperluan.'%20Mohon%20disetujui.');
    exit;
  }
}

include '../includes/header.php';

?>


<section class="w-full bg-white pt-12 pb-6">
  <div class="max-w-3xl mx-auto px-4 text-center">
    <div class="w-20 h-20 mx-auto rounded-full bg-blue-50 flex items-center justify-center shadow-sm mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM5 20V9h14v11H5zM7 11h5v5H7z"/>
      </svg>
    </div>

    <h1 class="text-3xl md:text-4xl font-extrabold text-text-dark mb-2">Peminjaman Alat & Ruang</h1>
    <p class="text-base text-medium text-text-dark/80">Silakan isi form di bawah ini untuk melakukan peminjaman</p>
    <br></br>
  </div>
  <!-- Form container -->
<section class="w-full pb-20">
    <div class="max-w-3xl mx-auto px-4">

      <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="bg-primary text-white text-center py-4 px-6">
          <h3 class="text-lg font-bold">Form Pengajuan Peminjaman</h3>
        </div>

        <div class="p-6">
            <?php 
            if ($message != null): ?>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="alert alert-<?= htmlspecialchars($message['type']) ?> alert-dismissible fade show" role="alert">
                  <?= htmlspecialchars($message['msg']) ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
            <?php endif; ?>
          <form method="POST" action="" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">Nama</label>
                <input type="text" name="nama" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary" placeholder="Nama lengkap">
              </div>

              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">No. Induk (NIP/NIM)</label>
                <input type="text" name="no_induk" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary" placeholder="Contoh: 12345678">
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary">
              </div>
              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary">
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">Jam Mulai</label>
                <input type="time" name="mulai" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary">
              </div>
              <div>
                <label class="block text-sm font-medium text-text-dark mb-1">Jam Selesai</label>
                <input type="time" name="selesai" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-text-dark mb-1">Nomor WhatsApp</label>
              <input type="text" name="no_wa" rows="4" class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary" placeholder="Contoh: 6285123456789">
            </div>

            <div>
              <label class="block text-sm font-medium text-text-dark mb-1">Keperluan</label>
              <textarea name="keperluan" rows="4" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary" placeholder="Jelaskan keperluan peminjaman..."></textarea>
            </div>

            <div class="mt-2">
              <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 mb-3 bg-primary hover:bg-yellow-500 text-white rounded-md font-medium">
                Kirim Pengajuan
              </button>
              <a href="" class="w-full inline-flex justify-center items-center px-6 py-3 mb-3 bg-cyan-500 hover:bg-yellow-500 text-white rounded-md font-medium">
                Refresh Halaman
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
</section>

  <section class="w-full pb-20">
    <div class="max-w-5xl mx-auto px-4">
      <div class="bg-white rounded-2xl shadow overflow-hidden p-4">
        <h3 class="text-lg font-bold mb-4">Informasi Peminjaman</h3>
        <?php 
        $bookings = PeminjamanController::fetchAll();
        ?>
        <?php if (empty($bookings)): ?>
          <p class="text-sm text-medium">Belum ada data peminjaman.</p>
        <?php else: ?>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-50">
                <tr>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Induk</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Mulai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jam Mulai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jam Selesai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keperluan</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <?php
                $now = new DateTime();
                foreach ($bookings as $b):
                ?>
                  <tr>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['nama_peminjam']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['no_induk']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['tanggal_mulai']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['tanggal_selesai']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['jam_mulai']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['jam_selesai']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['keperluan']); ?></td>
                    <td class="px-4 py-3 text-sm">
                    <?php 
                    if($b['status'] == 'menunggu'){                    
                    ?>  
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 <?php echo $statusClass; ?>"><?php echo $b['status']; ?></span></td>
                    <?php }; ?>
                    <?php 
                    if($b['status'] == 'diterima'){                    
                    ?>  
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 <?php echo $statusClass; ?>"><?php echo $b['status']; ?></span></td>
                    <?php }; ?>
                    <?php 
                    if($b['status'] == 'ditolak'){                    
                    ?>  
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-white-800 <?php echo $statusClass; ?>"><?php echo $b['status']; ?></span></td>
                    <?php }; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
</section>

<?php
include '../includes/footer.php';
?>

