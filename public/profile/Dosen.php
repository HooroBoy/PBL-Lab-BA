<?php

$page_title = 'Daftar Dosen';

// --- Menggunakan Model Dosen untuk Mengambil Data Dinamis ---
// Asumsi: File model Dosen.php terletak di /app/models/
require_once __DIR__ . '/../../app/models/Dosencontroller.php'; 

// Mengambil semua data dosen dari database
try {
    // Model Dosen::all() akan mengembalikan array dari tabel 'dosen'
    $dosenList = Dosen::all();
} catch (PDOException $e) {
    $dosenList = []; // Set array kosong jika terjadi error database
    echo "<p class='text-center text-red-600'>Gagal memuat daftar dosen dari database: Pastikan tabel 'dosen' sudah ada. (" . $e->getMessage() . ")</p>";
}

// Fungsi helper untuk path gambar
// Fungsi helper untuk path gambar yang sudah diperbaiki
function dosen_image_or_placeholder($path) {
    // 1. Cek jika data kosong
    if (empty($path)) {
        return 'https://placehold.co/400x400/e2e8f0/1e293b?text=No+Image';
    }

    // 2. Cek jika path adalah URL eksternal (http/https)
    if (strpos($path, 'http') === 0) {
        return $path;
    }

    // 3. Bersihkan path dari database
    // Database menyimpan: /assets/Dosen/namafile.jpg (sesuai kode admin)
    // Kita hilangkan slash di depan agar mudah digabung
    $clean_path = ltrim($path, '/'); 

    // 4. Definisikan Root Project untuk URL Browser
    // Ganti '/PBL-Lab-BA/public/' sesuai nama folder project Anda di htdocs
    $base_url = '/PBL-Lab-BA/public/';

    // 5. Cek ketersediaan file fisik di Server (Optional tapi recommended)
    // Menggunakan $_SERVER['DOCUMENT_ROOT'] untuk mencari path fisik absolute
    $physical_path = $_SERVER['DOCUMENT_ROOT'] . $base_url . $clean_path;

    if (file_exists($physical_path)) {
        // Jika file ketemu, return path lengkap untuk browser
        return $base_url . $clean_path;
    }

    // 6. Fallback jika file fisik tidak ditemukan meskipun path ada di DB
    // Pastikan file default-avatar.png benar-benar ada di folder assets/Dosen/ atau assets/ImageDosen/
    return 'https://placehold.co/400x400/e2e8f0/1e293b?text=Not+Found'; 
}


// If this file is included with DOSEN_DATA_ONLY defined, do not render HTML.
if (defined('DOSEN_DATA_ONLY') && constant('DOSEN_DATA_ONLY')) {
  return;
}

// --- Render the listing page when accessed directly ---
include '../includes/header.php';
?>

<section class="w-full bg-white pt-12 pb-20">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-text-dark mb-8">Daftar Dosen</h1>

      <?php if (!empty($dosenList)): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php foreach ($dosenList as $d):
       // Menggunakan kolom 'foto' dari database untuk path gambar
        // Perbaiki asumsi kolom ID. Asumsi 'id' adalah kunci untuk LihatDosen.php
        $dosen_id = $d['id'] ?? $d['nidn']; 
        $img = dosen_image_or_placeholder($d['foto'] ?? '');
      ?>
                <a href="LihatDosen.php?id=<?php echo urlencode($dosen_id); ?>" class="group block bg-white rounded-2xl p-4 shadow-gray hover:shadow-xl transition relative overflow-hidden">
          <div class="flex flex-col items-center text-center">
            <div class="w-40 h-40 rounded-lg overflow-hidden mb-4 relative z-10">
              <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($d['nama']); ?>" class="w-full h-full object-cover" 
                   onerror="this.onerror=null; this.src='<?php echo dosen_image_or_placeholder('default'); ?>';" />
            </div>
            <h3 class="text-lg font-semibold text-text-dark mb-1 relative z-10"><?php echo htmlspecialchars($d['nama']); ?></h3>
            <div class="text-sm text-medium relative z-10">NIDN: <?php echo htmlspecialchars($d['nidn'] ?? '-'); ?></div>
            <div class="text-sm text-medium mt-1 relative z-10"><?php echo htmlspecialchars($d['program_studi'] ?? 'Tenaga Pengajar'); ?></div>
          </div>

                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center z-20">
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-4 py-2 bg-white text-primary font-bold rounded-full shadow-lg text-sm">
              View Profile
            </span>
          </div>
        </a>
              <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="text-center text-lg text-medium py-10">Data dosen tidak ditemukan atau gagal dimuat dari database.</p>
    <?php endif; ?>
  </div>
</section>

<?php include '../includes/footer.php'; ?>