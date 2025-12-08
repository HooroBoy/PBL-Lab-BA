<?php
// Pastikan path ke Dosencontroller.php sudah benar relatif dari folder public/profile
require_once __DIR__ . '/../../app/models/Dosencontroller.php'; 
require_once __DIR__ . '/../../app/models/Publikasi.php'; 

// --- Fungsi Helper Gambar (tetap) ---
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

// --- Fungsi Helper untuk Memproses Data JSON Pendidikan/Sertifikasi (tetap) ---
function format_dosen_detail($data) {
    $items = json_decode($data, true);
    if (!is_array($items)) {
        $string_items = array_filter(array_map('trim', explode("\n", $data ?? '')));
        return array_map(function($item) {
            return ['description' => $item];
        }, $string_items);
    }
    return $items;
}

// --- Pengambilan Data Dosen & Publikasi (tetap) ---
$dosen_id = $_GET['id'] ?? $_GET['nidn'] ?? null;
$d = null;

try {
    if ($dosen_id) {
        $d = Dosen::find($dosen_id);
    }
} catch (PDOException $e) {
    // Error database
}

if (!$d) {
    include '../includes/header.php';
    echo '<section class="max-w-4xl mx-auto p-8"><h2 class="text-2xl font-bold">Dosen tidak ditemukan</h2><p><a class="text-primary" href="Dosen.php">Kembali ke Daftar Dosen</a></p></section>';
    include '../includes/footer.php';
    exit;
}

$dosen_id_current = $dosen_id;
$publikasiList = Publikasi::findByDosenId($dosen_id_current);

// Persiapan data untuk kemudahan
$d['nama'] = $d['nama'] ?? 'Nama Dosen';
$d['nip'] = $d['nip'] ?? '-';
$d['nidn'] = $d['nidn'] ?? '-';
$d['program_studi'] = $d['program_studi'] ?? '-';
$d['email'] = $d['email'] ?? '-';
$d['gelar_depan'] = $d['gelar_depan'] ?? '';
$d['gelar_belakang'] = $d['gelar_belakang'] ?? '';

$nama_lengkap = trim(($d['gelar_depan'] ? $d['gelar_depan'] . ' ' : '') . $d['nama'] . ($d['gelar_belakang'] ? ', ' . $d['gelar_belakang'] : ''));

// Mengganti warna primer menjadi biru tua
$primary_color = 'bg-blue-800'; 
// Styling untuk tautan profil (Warna Kuning/Oranye seperti gambar 547afe.png)
$profile_link_class = "px-4 py-2 rounded-lg border text-sm font-semibold text-yellow-700 border-yellow-500 bg-white hover:bg-yellow-50 transition shadow-sm";

include '../includes/header.php';
?>

<section class="w-full bg-white pt-12 pb-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex justify-between items-start mb-6">
        <h1 class="text-3xl font-extrabold text-text-dark">Data Dosen</h1> 
        <a href="Dosen.php" class="px-5 py-2 text-sm font-semibold text-white <?php echo $primary_color; ?> rounded-lg hover:bg-blue-900 transition duration-300 shadow-md flex-shrink-0">
            Kembali ke Daftar Dosen
        </a>
    </div>

    <hr class="h-1 my-4 border-0 rounded bg-gradient-to-r from-yellow-500 to-blue-800 mb-8">
    
    <div class="flex flex-col md:flex-row md:items-start md:space-x-10">
      <div class="w-full md:w-64 mb-6 md:mb-0 flex-shrink-0">
                <img src="<?php echo htmlspecialchars(dosen_image_or_placeholder($d['foto'] ?? '')); ?>" 
            alt="<?php echo htmlspecialchars($d['nama']); ?>" 
            class="w-full h-auto object-cover rounded-lg shadow-lg border-2 border-gray-300" />
      </div>
      <div class="flex-1">
                <h2 class="text-2xl font-bold text-text-dark mb-4"><?php echo htmlspecialchars($nama_lengkap); ?></h2>
        
        <div class="flex flex-wrap gap-2 mb-4">
            <?php 
            $areas_string = $d['bidang_keahlian'] ?? '';
            $areas = array_filter(array_map('trim', explode(',', $areas_string)));
            
            // Tampilan Bidang Keahlian: Sebagai LINK FILTER (styling tags netral)
            foreach ($areas as $area): ?>
                <a href="Dosen.php?bidang=<?php echo urlencode($area); ?>" 
                   class="px-3 py-1 rounded-full border border-gray-300 text-sm text-text-dark bg-white hover:bg-gray-100 transition cursor-pointer shadow-sm">
                   <?php echo htmlspecialchars($area); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            <?php if (!empty($d['linkedin_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['linkedin_link']); ?>" target="_blank" 
                   class="<?php echo $profile_link_class; ?>">
                   LinkedIn
                </a>
            <?php endif; ?>
            <?php if (!empty($d['google_scholar_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['google_scholar_link']); ?>" target="_blank" 
                   class="<?php echo $profile_link_class; ?>">
                   Google Scholar
                </a>
            <?php endif; ?>
            <?php if (!empty($d['sinta_link'])): ?>
                <a href="<?php echo htmlspecialchars($d['sinta_link']); ?>" target="_blank" 
                   class="<?php echo $profile_link_class; ?>">
                   Sinta
                </a>
            <?php endif; ?>
        </div>
        
        <div class="mb-8 text-md space-y-1">
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Nama</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($nama_lengkap); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">NIP</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['nip']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">NIDN</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['nidn']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Program Studi</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['program_studi']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Email</div>
                <div class="flex-grow">: <a href="mailto:<?php echo htmlspecialchars($d['email']); ?>" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($d['email']); ?></a></div>
            </div>
        </div>

        <h2 class="text-xl font-bold text-text-dark mb-4 mt-8">Pendidikan & Sertifikasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="p-6 border rounded-xl bg-gray-50 shadow-sm">
            <h3 class="font-bold text-lg mb-3">Pendidikan</h3>
            <ul class="list-none text-sm text-medium space-y-3">
              <?php 
              $education_items = format_dosen_detail($d['pendidikan'] ?? '');
              if (!empty($education_items)):
                  foreach ($education_items as $edu): 
                      $jenjang = $edu['jenjang'] ?? '';
                      $jurusan = $edu['jurusan'] ?? $edu['description'] ?? '';
                      $kampus = $edu['kampus'] ?? '';
                      $tahun = $edu['tahun'] ?? '';
              ?>
                <li>
                    <div class="font-semibold text-text-dark">
                        <?php echo htmlspecialchars($jenjang); ?> &mdash; <?php echo htmlspecialchars($jurusan); ?>
                    </div>
                    <div class="text-medium pl-4">
                        <?php echo htmlspecialchars($kampus); ?> 
                        <?php if ($tahun) echo ' (' . htmlspecialchars($tahun) . ')'; ?>
                    </div>
                </li>
              <?php endforeach; else: ?>
                <li>Data Pendidikan tidak tersedia.</li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="p-6 border rounded-xl bg-gray-50 shadow-sm">
            <h3 class="font-bold text-lg mb-3">Sertifikasi</h3>
            <?php 
                $cert_items = format_dosen_detail($d['sertifikasi'] ?? '');
                if (!empty($cert_items) && count($cert_items) > 0 && ($cert_items[0]['description'] ?? '') != '-'):
            ?>
                <ul class="list-none text-sm text-medium space-y-2">
                    <?php 
                        foreach ($cert_items as $c): 
                            $tahun = $c['tahun'] ?? '';
                            $penerbit = $c['penerbit'] ?? '';
                            $nama = $c['nama_sertifikasi'] ?? $c['description'] ?? '';
                    ?>
                    <li>
                        <?php 
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
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
              <div class="text-sm text-medium">-</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-16">
        <h2 class="text-2xl font-bold text-text-dark mb-6 border-b-2 border-gray-300 pb-2">Publikasi (<?php echo count($publikasiList); ?>)</h2>
        
        <?php if (!empty($publikasiList)): ?>
        <ul class="space-y-6">
            <?php foreach ($publikasiList as $publikasi): 
                $penulis_nama = array_column($publikasi['penulis'], 'nama');
                $penulis_text = implode(', ', $penulis_nama);
                
                $detail_publikasi = [];
                if (!empty($publikasi['nama_penerbit'])) {
                    $detail_publikasi[] = htmlspecialchars($publikasi['nama_penerbit']);
                }
                if (!empty($publikasi['tahun_terbit'])) {
                    $detail_publikasi[] = htmlspecialchars($publikasi['tahun_terbit']);
                }
                $detail_text = implode(', ', $detail_publikasi);
            ?>
            <li class="p-4 border rounded-lg hover:bg-gray-50 transition duration-150 relative">
                <h3 class="text-lg font-semibold text-blue-800 mb-1">
                    <?php echo htmlspecialchars($publikasi['judul']); ?>
                </h3>
                
                <div class="text-sm text-medium space-y-1">
                    <p>
                        <span class="font-semibold">Penulis:</span> <?php echo $penulis_text; ?>
                    </p>
                    <p>
                        <span class="font-semibold">Jenis:</span> <?php echo htmlspecialchars($publikasi['jenis_publikasi']); ?>
                        <?php if (!empty($detail_text)): ?>
                            <span class="mx-2 text-gray-400">|</span> 
                            <?php echo $detail_text; ?>
                        <?php endif; ?>
                    </p>
                    <?php if (!empty($publikasi['doi'])): ?>
                        <p>
                            <span class="font-semibold">DOI:</span> <a href="https://doi.org/<?php echo urlencode($publikasi['doi']); ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($publikasi['doi']); ?></a>
                        </p>
                    <?php endif; ?>
                </div>

                <a href="../publikasi.php?id=<?php echo htmlspecialchars($publikasi['id']); ?>" 
                    class="absolute bottom-4 right-4 text-sm font-semibold text-blue-600 hover:underline">
                    Detail &raquo;
                </a>

            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="text-medium italic">Dosen ini belum memiliki data publikasi yang tercatat.</p>
        <?php endif; ?>
    </div>

  </div>
</section>

<?php
include '../includes/footer.php';
?>