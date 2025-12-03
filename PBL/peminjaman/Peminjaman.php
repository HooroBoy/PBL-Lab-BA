<?php
// Page: Peminjaman Alat & Ruang
$page_title = 'Peminjaman Alat & Ruang';
include '../includes/header.php';

// Local helper: validate, check overlap, and save peminjaman to CSV
function insertJadwal($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan) {
    $nama = trim((string)$nama);
    $no_induk = trim((string)$no_induk);
    $keperluan = trim((string)$keperluan);

    // Basic validation
    if ($nama === '' || $no_induk === '' || $tanggal_mulai === '' || $tanggal_selesai === '' || $jam_mulai === '' || $jam_selesai === '') {
        return ['type' => 'danger', 'msg' => 'Semua field wajib diisi.'];
    }

    $start = DateTime::createFromFormat('Y-m-d H:i', $tanggal_mulai . ' ' . $jam_mulai);
    $end = DateTime::createFromFormat('Y-m-d H:i', $tanggal_selesai . ' ' . $jam_selesai);
    if (!$start || !$end) {
        return ['type' => 'danger', 'msg' => 'Format tanggal/jam tidak valid.'];
    }
    if ($end <= $start) {
        return ['type' => 'danger', 'msg' => 'Waktu selesai harus lebih besar dari waktu mulai.'];
    }

    $dataFile = __DIR__ . '/peminjaman_data.csv';

    // Ensure file exists and has header
    if (!file_exists($dataFile)) {
        $h = fopen($dataFile, 'w');
        if ($h) {
            fputcsv($h, ['id','nama','no_induk','start','end','keperluan','created_at']);
            fclose($h);
        }
    }

    // Check overlap
    if (($h = fopen($dataFile, 'r')) !== false) {
        // skip header
        $header = fgetcsv($h);
        while (($row = fgetcsv($h)) !== false) {
            // Expecting at least 5 columns (id, nama, no_induk, start, end, ...)
            if (count($row) < 5) continue;
            $existingStart = DateTime::createFromFormat('Y-m-d H:i', $row[3]);
            $existingEnd = DateTime::createFromFormat('Y-m-d H:i', $row[4]);
            if ($existingStart && $existingEnd) {
                // overlap if newStart < existingEnd AND newEnd > existingStart
                if ($start < $existingEnd && $end > $existingStart) {
                    fclose($h);
                    return ['type' => 'danger', 'msg' => 'Gagal: terdapat jadwal yang bertabrakan dengan peminjaman lain.'];
                }
            }
        }
        fclose($h);
    }

    // Append new booking
    $id = time();
    $created_at = (new DateTime())->format('Y-m-d H:i');
    if (($h = fopen($dataFile, 'a')) === false) {
        return ['type' => 'danger', 'msg' => 'Gagal menyimpan data. Periksa permission file.'];
    }
    $row = [$id, $nama, $no_induk, $start->format('Y-m-d H:i'), $end->format('Y-m-d H:i'), $keperluan, $created_at];
    fputcsv($h, $row);
    fclose($h);

    return ['type' => 'success', 'msg' => 'Pengajuan berhasil dikirim.'];
}

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan trim
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $no_induk = isset($_POST['no_induk']) ? trim($_POST['no_induk']) : '';
    $tanggal_mulai = $_POST['tanggal_mulai'] ?? '';
    $tanggal_selesai = $_POST['tanggal_selesai'] ?? '';
    $jam_mulai = $_POST['mulai'] ?? '';
    $jam_selesai = $_POST['selesai'] ?? '';
    $keperluan = isset($_POST['keperluan']) ? trim($_POST['keperluan']) : '';

    // Panggil fungsi lokal yang melakukan validasi & cek overlap
    $result = insertJadwal(
        $nama,
        $no_induk,
        $tanggal_mulai,
        $tanggal_selesai,
        $jam_mulai,
        $jam_selesai,
        $keperluan
    );

    // Set flash message ke session dan redirect (PRG)
    $_SESSION['flash'] = $result;
    // Redirect ke halaman yang sama (hindari resubmit)
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Ambil pesan dari session (jika ada) — tampilkan sekali
if (isset($_SESSION['flash'])) {
    $message = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
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
  <!-- Form container (Tailwind card to match design) -->
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
              <label class="block text-sm font-medium text-text-dark mb-1">Keperluan</label>
              <textarea name="keperluan" rows="4" required class="block w-full border border-gray-200 rounded-md p-2 focus:ring-primary focus:border-primary" placeholder="Jelaskan keperluan peminjaman..."></textarea>
            </div>

            <div class="mt-2">
              <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium">Kirim Pengajuan</button>
            </div>

          </form>
        </div>
      </div>
    </div>
</section>

  <!-- Daftar peminjaman (mengambil data dari CSV) -->
  <?php
  $dataFile = __DIR__ . '/peminjaman_data.csv';
  $bookings = [];
  if (file_exists($dataFile) && ($h = fopen($dataFile, 'r')) !== false) {
      // read header
      $hdr = fgetcsv($h);
      while (($row = fgetcsv($h)) !== false) {
          $bookings[] = [
              'id' => $row[0] ?? '',
              'nama' => $row[1] ?? '',
              'no_induk' => $row[2] ?? '',
              'start' => $row[3] ?? '',
              'end' => $row[4] ?? '',
              'keperluan' => $row[5] ?? '',
              'created_at' => $row[6] ?? '',
          ];
      }
      fclose($h);
  }
  ?>

  <section class="w-full pb-20">
    <div class="max-w-3xl mx-auto px-4">
      <div class="bg-white rounded-2xl shadow overflow-hidden p-4">
        <h3 class="text-lg font-bold mb-4">Informasi Peminjaman</h3>

        <?php if (empty($bookings)): ?>
          <p class="text-sm text-medium">Belum ada data peminjaman.</p>
        <?php else: ?>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Induk</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Mulai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Selesai</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keperluan</th>
                  <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <?php
                $now = new DateTime();
                foreach ($bookings as $b):
                    $start = DateTime::createFromFormat('Y-m-d H:i', $b['start']);
                    $end = DateTime::createFromFormat('Y-m-d H:i', $b['end']);
                    $status = '-';
                    if ($start && $end) {
                        if ($now < $start) {
                            $status = 'Pending';
                            $statusClass = 'bg-yellow-100 text-yellow-800';
                        } elseif ($now >= $start && $now <= $end) {
                            $status = 'Sedang Dipinjam';
                            $statusClass = 'bg-blue-100 text-blue-800';
                        } else {
                            $status = 'Selesai';
                            $statusClass = 'bg-green-100 text-green-800';
                        }
                    } else {
                        $status = 'Tidak diketahui';
                        $statusClass = 'bg-gray-100 text-gray-800';
                    }
                ?>
                  <tr>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['nama']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['no_induk']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['start']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['end']); ?></td>
                    <td class="px-4 py-3 text-sm text-text-dark"><?php echo htmlspecialchars($b['keperluan']); ?></td>
                    <td class="px-4 py-3 text-sm"><span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?php echo $statusClass; ?>"><?php echo $status; ?></span></td>
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
// Memanggil Footer (<footer>, tag penutup)
include '../includes/footer.php';
?>

