<?php
function tgl_indo($tanggal)
{
  $bulan = array(
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
  return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$page_title = 'Peminjaman Alat & Ruang';
require_once '../../app/controllers/PeminjamanController.php';

// Start session to handle flash messages
$message = null;
if (isset($_SESSION['alerts'])) {
  $message = $_SESSION['alerts'];
  unset($_SESSION['alerts']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
  $no_induk = isset($_POST['no_induk']) ? trim($_POST['no_induk']) : '';
  $tanggal_mulai = $_POST['tanggal_mulai'] ?? '';
  $tanggal_selesai = $_POST['tanggal_selesai'] ?? '';
  $jam_mulai = $_POST['mulai'] ?? '';
  $jam_selesai = $_POST['selesai'] ?? '';
  $keperluan = $_POST['keperluan'];
  $no_wa = $_POST['no_wa'];

  // Call the controller to insert the booking
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

  // Handle the result and set flash messages
  if ($result['type'] != 'success') {
    $_SESSION['alerts'] = $result;
    $_POST = array();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  } else {

    $_SESSION['alerts'] = $result;
    $waUrl = 'https://api.whatsapp.com/send?phone=6285183192045&text=Halo%20Admin,%20saya%20' . rawurlencode($nama) . '%20ingin%20melakukan%20peminjaman%20pada%20tanggal%20' . tgl_indo($tanggal_mulai) . '%20s.d%20tanggal%20' . tgl_indo($tanggal_selesai) . '%20untuk%20' . rawurlencode($keperluan) . '%20Mohon%20disetujui.';
    $_SESSION['wa_redirect'] = $waUrl;
    $_POST = array();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

include '../includes/header.php';
$autoRedirectWA = null;
if (isset($_SESSION['wa_redirect'])) {
  $autoRedirectWA = $_SESSION['wa_redirect'];
  unset($_SESSION['wa_redirect']);
}
?>


<div class="w-full flex-1 flex flex-col bg-white">
  <section class="w-full bg-white pt-12 pb-6">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <div class="w-20 h-20 mx-auto rounded-full bg-blue-50 flex items-center justify-center shadow-sm mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM5 20V9h14v11H5zM7 11h5v5H7z" />
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
          $bookings = PeminjamanController::fetchApproved();
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
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php if ($autoRedirectWA): ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Tunggu 2 detik (2000ms) agar user sempat melihat alert Sukses
          setTimeout(function() {
            window.location.href = "<?php echo $autoRedirectWA; ?>";
          }, 2000);
        });
      </script>
    <?php endif; ?>

    <!-- SweetAlert for flash messages -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if ($message): ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Tentukan tipe icon
          const type = '<?php echo ($message['type'] == 'danger') ? 'error' : 'success'; ?>';
          const title = '<?php echo ($message['type'] == 'danger') ? 'Mohon Maaf' : 'Berhasil!'; ?>';
          const text = '<?php echo $message['msg']; ?>';

          // Cek apakah ada request redirect ke WA
          const waLink = '<?php echo $autoRedirectWA ? $autoRedirectWA : ""; ?>';

          let swalConfig = {
            icon: type,
            title: title,
            text: text,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          };

          if (waLink) {
            swalConfig.showConfirmButton = true;
            swalConfig.confirmButtonText = 'Lanjut ke WhatsApp 👉';
            swalConfig.text = text + '\n\nSilakan klik tombol di bawah untuk membuka WhatsApp.';
          }


          Swal.fire(swalConfig).then((result) => {
            if (result.isConfirmed && waLink) {
              window.open(waLink, '_blank');
            }
          });
        });
      </script>
    <?php endif; ?>
</div>
<?php if ($message): ?>
<?php endif; ?>

<?php
include '../includes/footer.php';
?>