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
    // Tampilkan pesan error hanya saat debugging, bisa dihapus di production
    // echo "<p class='text-center text-red-600'>Gagal memuat daftar dosen dari database: Pastikan tabel 'dosen' sudah ada. (" . $e->getMessage() . ")</p>";
}

// Fungsi helper untuk path gambar (tetap sama)
function dosen_image_or_placeholder($path) {
    if (empty($path)) {
        return 'https://placehold.co/400x400/e2e8f0/1e293b?text=No+Image';
    }

    if (strpos($path, 'http') === 0) {
        return $path;
    }

    $clean_path = ltrim($path, '/'); 
    $base_url = '/PBL-Lab-BA/public/'; // SESUAIKAN DENGAN NAMA FOLDER PROJECT ANDA

    $physical_path = $_SERVER['DOCUMENT_ROOT'] . $base_url . $clean_path;

    if (file_exists($physical_path)) {
        return $base_url . $clean_path;
    }

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
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-3xl font-extrabold text-text-dark mb-12">Tim Kami</h1>
        <?php if (!empty($dosenList)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <?php foreach ($dosenList as $d):
        // Ambil ID/NIDN untuk link
        $dosen_id = $d['id'] ?? $d['nidn']; 
        // Ambil gambar
        $img = dosen_image_or_placeholder($d['foto'] ?? '');
      ?>
                <a href="LihatDosen.php?id=<?php echo urlencode($dosen_id); ?>" class="group block bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 relative overflow-hidden">
          <div class="flex flex-col items-center text-center p-0">
                            <div class="w-full h-72 overflow-hidden mb-4 relative z-10 rounded-t-xl">
              <img src="<?php echo $img; ?>" 
                    alt="<?php echo htmlspecialchars($d['nama']); ?>" 
                    class="w-full h-full object-cover transition duration-300 group-hover:scale-105" 
                   onerror="this.onerror=null; this.src='<?php echo dosen_image_or_placeholder('default'); ?>';" />
            </div>

                <div class="p-4 pt-0">
                    <h3 class="text-lg font-semibold text-text-dark mb-1 relative z-10"><?php echo htmlspecialchars($d['nama']); ?></h3>
                                        <div class="text-sm text-medium relative z-10">
                        <?php echo htmlspecialchars($d['program_studi'] ?? 'Tenaga Pengajar'); ?>
                    </div>
                </div>
          </div>

                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center z-20">
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-5 py-2 bg-white text-primary font-bold rounded-full shadow-lg text-sm border-2 border-primary">
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