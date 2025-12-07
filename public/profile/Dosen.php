<?php

$page_title = 'Daftar Dosen';

// --- Menggunakan Model Dosen untuk Mengambil Data Dinamis ---
// Asumsi: File model Dosencontroller.php terletak di /app/models/
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
function dosen_image_or_placeholder($path) {
    // Path untuk mencari gambar di server
    $candidate = __DIR__ . DIRECTORY_SEPARATOR . str_replace('../', '', $path);
    // Kita asumsikan kolom 'foto' di database hanya menyimpan nama file atau path relatif
    
    // Karena kita sekarang mengambil dari database, kita perlu memastikan path dasar assets/ImageDosen/
    $base_path = '/assets/ImageDosen/'; 
    $full_path = $base_path . basename($path);

    // Untuk memastikan gambar ada, biasanya dilakukan pengecekan file_exists() pada path server
    // Namun, untuk lingkungan web umum, kita andalkan placeholder jika path asli database tidak valid.
    
    if (strpos($path, 'http') === 0 || strpos($path, 'https') === 0) {
        return $path; // Jika path adalah URL
    } elseif (basename($path) && file_exists(dirname(__DIR__, 2) . $full_path)) {
        return $full_path;
    } else {
        // Fallback placeholder jika gambar tidak ditemukan atau path di database kosong
        return '/assets/ImageDosen/default-avatar.png'; 
    }
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
        $img = dosen_image_or_placeholder($d['foto'] ?? '');
      ?>
        <!-- Setiap kartu dosen kini menggunakan data dari database -->
        <a href="LihatDosen.php?id=<?php echo urlencode($d['id']); ?>" class="block bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition">
          <div class="flex flex-col items-center text-center">
            <div class="w-40 h-40 rounded-lg overflow-hidden mb-4">
              <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($d['nama']); ?>" class="w-full h-full object-cover" 
                   onerror="this.onerror=null; this.src='<?php echo dosen_image_or_placeholder('default'); ?>';" />
            </div>
            <h3 class="text-lg font-semibold text-text-dark mb-1"><?php echo htmlspecialchars($d['nama']); ?></h3>
            <div class="text-sm text-medium">NIDN: <?php echo htmlspecialchars($d['nidn'] ?? '-'); ?></div>
            <div class="text-sm text-medium mt-1"><?php echo htmlspecialchars($d['program_studi'] ?? 'Tenaga Pengajar'); ?></div>
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