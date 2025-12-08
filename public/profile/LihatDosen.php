<?php
// Pastikan path ke Dosencontroller.php sudah benar relatif dari folder public/profile
require_once __DIR__ . '/../../app/models/Dosencontroller.php'; 

// --- Fungsi Helper Gambar (Ambil dari Dosen.php) ---
function dosen_image_or_placeholder($path) {
    if (empty($path) || strpos($path, 'http') === 0) {
        return $path ?: 'https://placehold.co/400x400/e2e8f0/1e293b?text=No+Image';
    }
    $clean_path = ltrim($path, '/');
    $base_url = '/PBL-Lab-BA/public/'; // PASTIKAN INI SESUAI DENGAN FOLDER PROJECT ANDA
    $physical_path = $_SERVER['DOCUMENT_ROOT'] . $base_url . $clean_path;

    if (file_exists($physical_path)) {
        return $base_url . $clean_path;
    }
    return 'https://placehold.co/400x400/e2e8f0/1e293b?text=Not+Found'; 
}

// --- Fungsi Helper untuk Memproses Data JSON Pendidikan/Sertifikasi ---
function format_dosen_detail($data, $type = 'pendidikan') {
    // Coba decode JSON, jika gagal (bukan JSON) kembalikan array kosong
    $items = json_decode($data, true);
    if (!is_array($items)) {
        // Jika bukan JSON, asumsikan string dipisahkan baris
        $string_items = array_filter(array_map('trim', explode("\n", $data ?? '')));
        return array_map(function($item) {
            return ['description' => $item]; // Bungkus sebagai array agar konsisten
        }, $string_items);
    }
    return $items;
}

// --- Pengambilan Data Dosen Berdasarkan ID/NIDN ---
$dosen_id = $_GET['id'] ?? $_GET['nidn'] ?? null;
$d = null;

try {
    if ($dosen_id) {
        // ASUMSI: Model Dosen::find($id) mengembalikan ARRAY data DOSEN LENGKAP
        $d = Dosen::find($dosen_id);
    }
} catch (PDOException $e) {
    // Error database
}

// Jika data dosen tidak ditemukan
if (!$d) {
    include '../includes/header.php';
    echo '<section class="max-w-4xl mx-auto p-8"><h2 class="text-2xl font-bold">Dosen tidak ditemukan</h2><p><a class="text-primary" href="Dosen.php">Kembali ke Daftar Dosen</a></p></section>';
    include '../includes/footer.php';
    exit;
}

include '../includes/header.php';
?>

<section class="w-full bg-white pt-12 pb-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-extrabold text-text-dark">Data Dosen</h1> 
        <a href="Dosen.php" class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-full hover:bg-blue-800 transition duration-300 shadow-md">
            Kembali ke Daftar Dosen
        </a>
    </div>

    <hr class="mb-8 border-gray-200">
    
    <div class="flex flex-col md:flex-row md:items-start md:space-x-10">
      <div class="w-full md:w-64 mb-6 md:mb-0 flex-shrink-0">
                <img src="<?php echo htmlspecialchars(dosen_image_or_placeholder($d['foto'] ?? '')); ?>" 
            alt="<?php echo htmlspecialchars($d['nama'] ?? 'Dosen'); ?>" 
            class="w-full h-auto object-cover rounded-lg shadow-lg" />
      </div>
      <div class="flex-1">
                <h2 class="text-2xl font-bold text-text-dark mb-4"><?php echo htmlspecialchars($d['nama'] ?? 'Nama Dosen'); ?></h2>
        
        <div class="flex flex-wrap gap-2 mb-6">
            <?php 
            // ASUMSI: bidang_keahlian disimpan sebagai string dipisahkan koma
            $areas_string = $d['bidang_keahlian'] ?? '';
            $areas = array_filter(array_map('trim', explode(',', $areas_string)));
            
            // Tampilkan Bidang Keahlian (Tags)
            foreach ($areas as $area): ?>
                <span class="px-3 py-1 rounded-full border text-sm text-text-dark bg-gray-100 hover:bg-gray-200 transition cursor-default"><?php echo htmlspecialchars($area); ?></span>
            <?php endforeach; ?>
            
            <?php if (!empty($d['linkedin_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['linkedin_link']); ?>" target="_blank" class="px-3 py-1 rounded-full border text-sm font-semibold text-text-dark bg-yellow-100 hover:bg-yellow-200 transition">LinkedIn</a>
            <?php endif; ?>
            <?php if (!empty($d['google_scholar_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['google_scholar_link']); ?>" target="_blank" class="px-3 py-1 rounded-full border text-sm font-semibold text-text-dark bg-yellow-100 hover:bg-yellow-200 transition">Google Scholar</a>
            <?php endif; ?>
            <?php if (!empty($d['sinta_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['sinta_link']); ?>" target="_blank" class="px-3 py-1 rounded-full border text-sm font-semibold text-text-dark bg-yellow-100 hover:bg-yellow-200 transition">Sinta</a>
            <?php endif; ?>
        </div>

        <div class="mb-8 space-y-2 text-md">
            <div class="grid grid-cols-2 gap-x-4">
                <div class="font-semibold w-40 inline-block">Nama</div> <div>: <?php echo htmlspecialchars($d['nama'] ?? '-'); ?></div>
                <div class="font-semibold w-40 inline-block">NIP</div> <div>: <?php echo htmlspecialchars($d['nip'] ?? '-'); ?></div>
                <div class="font-semibold w-40 inline-block">NIDN</div> <div>: <?php echo htmlspecialchars($d['nidn'] ?? '-'); ?></div>
                <div class="font-semibold w-40 inline-block">Program Studi</div> <div>: <?php echo htmlspecialchars($d['program_studi'] ?? '-'); ?></div>
                <div class="font-semibold w-40 inline-block">Email</div> <div>: <a href="mailto:<?php echo htmlspecialchars($d['email'] ?? '#'); ?>" class="text-primary hover:underline"><?php echo htmlspecialchars($d['email'] ?? '-'); ?></a></div>
            </div>
        </div>

        <h2 class="text-xl font-bold text-text-dark mb-4 mt-8">Pendidikan & Sertifikasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="p-6 border rounded-xl bg-gray-50 shadow-sm">
            <h3 class="font-bold text-lg mb-3">Pendidikan</h3>
            <ul class="list-disc pl-5 text-sm text-medium space-y-2">
              <?php 
              $education_items = format_dosen_detail($d['pendidikan'] ?? '', 'pendidikan');
              if (!empty($education_items)):
                  foreach ($education_items as $edu): 
                      // ASUMSI: Struktur JSON Pendidikan adalah [{"tahun": "...", "kampus": "...", "jenjang": "...", "jurusan": "..."}]
                      $tahun = $edu['tahun'] ?? '';
                      $jenjang = $edu['jenjang'] ?? '';
                      $jurusan = $edu['jurusan'] ?? $edu['description'] ?? '';
                      $kampus = $edu['kampus'] ?? '';
              ?>
                <li>
                    <?php 
                        // Format output: S3 - Teknik Informatika Bina Nusantara University (2016-2021)
                        echo htmlspecialchars($jenjang . ' - ' . $jurusan . ' ' . $kampus);
                        if ($tahun) echo ' (' . htmlspecialchars($tahun) . ')';
                    ?>
                </li>
              <?php endforeach; else: ?>
                <li>Data Pendidikan tidak tersedia.</li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="p-6 border rounded-xl bg-gray-50 shadow-sm">
            <h3 class="font-bold text-lg mb-3">Sertifikasi</h3>
            <ul class="list-disc pl-5 text-sm text-medium space-y-2">
              <?php 
                $cert_items = format_dosen_detail($d['sertifikasi'] ?? '', 'sertifikasi');
                if (!empty($cert_items)):
                    foreach ($cert_items as $c): 
                        // ASUMSI: Struktur JSON Sertifikasi adalah [{"tahun": "...", "penerbit": "...", "nama_sertifikasi": "..."}]
                        $tahun = $c['tahun'] ?? '';
                        $penerbit = $c['penerbit'] ?? '';
                        $nama = $c['nama_sertifikasi'] ?? $c['description'] ?? '';
                ?>
                <li>
                    <?php 
                        // Format output: ADOBE (2023, ORACLE)
                        echo htmlspecialchars($nama);
                        if ($tahun || $penerbit) {
                            echo ' (';
                            if ($tahun) echo htmlspecialchars($tahun);
                            if ($tahun && $penerbit) echo ', ';
                            if ($penerbit) echo htmlspecialchars($penerbit);
                            echo ')';
                        }
                    ?>
                </li>
              <?php endforeach; else: ?>
                <li>Data Sertifikasi tidak tersedia.</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include '../includes/footer.php';
?>