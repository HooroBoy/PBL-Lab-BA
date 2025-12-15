<?php
$page_title = "Detail Dosen Laboratory of Business Analytics";

require_once __DIR__ . '/../../app/models/Dosencontroller.php'; 
require_once __DIR__ . '/../../app/models/Publikasi.php'; 

function dosen_image_or_placeholder($path) {
    if (empty($path) || strpos($path, 'http') === 0) {
        return $path ?: 'https://placehold.co/400x400/e2e8f0/1e293b?text=No+Image';
    }
    $clean_path = ltrim($path, '/');
    $base_url = '/PBL-Lab-BA/public/'; 
    $physical_path = $_SERVER['DOCUMENT_ROOT'] . $base_url . $clean_path;

    if (file_exists($physical_path)) {
        return $base_url . $clean_path;
    }
    return 'https://placehold.co/400x400/e2e8f0/1e293b?text=Not+Found'; 
}

// --- Fungsi Helper ---
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

// --- Pengambilan Data Dosen & Publikasi ---
$dosen_id = $_GET['id'] ?? $_GET['nidn'] ?? null;
$d = null;

try {
    if ($dosen_id) {
        $d = Dosen::find($dosen_id);
        // --- AMBIL BIDANG KEAHLIAN DINAMIS ---
        $bidang_keahlian_list = Dosen::getBidangKeahlian($dosen_id);
        // Gabungkan list menjadi string yang dipisahkan koma untuk variabel $d['bidang_keahlian']
        $d['bidang_keahlian'] = implode(', ', $bidang_keahlian_list);
        // --- AKHIR AMBIL BIDANG KEAHLIAN DINAMIS ---
    }
} catch (PDOException $e) {
}

if (!$d) {
    include '../includes/header.php';
    echo '<section class="max-w-4xl mx-auto p-8"><h2 class="text-2xl font-bold">Dosen tidak ditemukan</h2><p><a class="text-primary" href="Dosen.php">Kembali ke Daftar Dosen</a></p></section>';
    include '../includes/footer.php';
    exit;
}

// --- START: DATA UJI COBA SEMENTARA UNTUK MEMASTIKAN TAMPILAN ---
// HAPUS BLOK INI SETELAH ANDA MEMASUKKAN DATA KE DATABASE ASLI
//$d['bidang_keahlian'] = 'Learning EngineeringTechnology, Data Mining, Sistem Cerdas'; 
$d['linkedin_link'] = 'https://linkedin.com/in/dosen_anda';
$d['google_scholar_link'] = 'https://scholar.google.com/citations?user=dosen_anda';
$d['sinta_link'] = 'https://sinta.kemdikbud.go.id/authors/profile/dosen_anda';
// --- END: DATA UJI COBA SEMENTARA ---

$dosen_id_current = $dosen_id;
$publikasiList = Publikasi::findByDosenId($dosen_id_current);

$d['nama'] = $d['nama'] ?? 'Nama Dosen';
$d['nip'] = $d['nip'] ?? '-';
$d['nidn'] = $d['nidn'] ?? '-';
$d['program_studi'] = $d['program_studi'] ?? '-';
$d['email'] = $d['email'] ?? '-';
$d['gelar_depan'] = $d['gelar_depan'] ?? '';
$d['gelar_belakang'] = $d['gelar_belakang'] ?? '';

// Fallbacks untuk field biodata tambahan
$d['jenis_kelamin'] = $d['jenis_kelamin'] ?? '-';
$d['jabatan'] = $d['jabatan'] ?? ($d['jabatan_fungsional'] ?? '-');
$d['tempat_lahir'] = $d['tempat_lahir'] ?? '';
$d['tanggal_lahir'] = $d['tanggal_lahir'] ?? '';
$d['telepon'] = $d['telepon'] ?? ($d['no_telepon'] ?? '-');
$d['alamat_kantor'] = $d['alamat_kantor'] ?? ($d['alamat_kantor_lengkap'] ?? '-');
$d['telepon_faks'] = $d['telepon_faks'] ?? ($d['telepon_fax'] ?? '-');
$d['lulusan'] = $d['lulusan'] ?? '';
$d['mata_kuliah'] = $d['mata_kuliah'] ?? '';

$nama_lengkap = trim(($d['gelar_depan'] ? $d['gelar_depan'] . ' ' : '') . $d['nama'] . ($d['gelar_belakang'] ? ', ' . $d['gelar_belakang'] : ''));

$primary_color = 'bg-blue-800'; 
$profile_link_class = "px-4 py-2 rounded-lg border text-sm font-semibold border-blue-600 text-blue-600 bg-white hover:bg-blue-50 transition shadow-sm";

$area_tag_class = "px-3 py-1 rounded-full border border-gray-300 text-sm text-text-dark bg-white hover:bg-gray-100 transition cursor-pointer shadow-sm";

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

            <?php
            // Tampilkan ringkasan Pendidikan & Sertifikasi di bawah foto (kolom kiri)
            $education_items_left = format_dosen_detail($d['pendidikan'] ?? '');
            $cert_items_left = format_dosen_detail($d['sertifikasi'] ?? '');
            ?>
            <div class="mt-4 space-y-3">
                <details class="border rounded-lg bg-blue-500 hover:bg-gray-50 shadow-sm" role="group">
                    <summary class="px-4 py-3 cursor-pointer font-semibold text-sm">Pendidikan</summary>
                    <div class="p-4 pt-0">
                        <?php if (!empty($education_items_left)): ?>
                            <?php foreach ($education_items_left as $edu_left):
                                $jenjang_l = $edu_left['jenjang'] ?? '';
                                $jurusan_l = $edu_left['jurusan'] ?? $edu_left['description'] ?? '';
                                $kampus_l = $edu_left['kampus'] ?? '';
                                $tahun_l = $edu_left['tahun'] ?? '';
                            ?>
                            <div class="text-sm mb-2">
                                <div class="font-semibold"><?php echo htmlspecialchars($jenjang_l); ?><?php if ($jurusan_l) echo ' — ' . htmlspecialchars($jurusan_l); ?></div>
                                <div class="text-medium"><?php echo htmlspecialchars($kampus_l); ?> <?php if ($tahun_l) echo '(' . htmlspecialchars($tahun_l) . ')'; ?></div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-sm">-</div>
                        <?php endif; ?>
                    </div>
                </details>

                <details class="border rounded-lg bg-blue-500 hover:bg-gray-50 shadow-sm" role="group">
                    <summary class="px-4 py-3 cursor-pointer font-semibold text-sm">Sertifikasi</summary>
                    <div class="p-4 pt-0">
                        <?php if (!empty($cert_items_left) && count($cert_items_left) > 0 && ($cert_items_left[0]['description'] ?? '') != '-'): ?>
                            <ul class="list-none text-sm space-y-1">
                                <?php foreach ($cert_items_left as $c_left): ?>
                                    <li><?php echo htmlspecialchars($c_left['nama_sertifikasi'] ?? $c_left['description'] ?? ''); ?><?php if (!empty($c_left['tahun'])) echo ' (' . htmlspecialchars($c_left['tahun']) . ')'; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="text-sm">-</div>
                        <?php endif; ?>
                    </div>
                </details>
            </div>

      </div>
      <div class="flex-1">
                <h2 class="text-2xl font-bold text-text-dark mb-4"><?php echo htmlspecialchars($nama_lengkap); ?></h2>
        
        <div class="flex flex-wrap gap-2 mb-4">
          <?php 
          $areas_string = $d['bidang_keahlian'] ?? '';
          $areas = array_filter(array_map('trim', explode(',', $areas_string)));
          
          // Tampilan Bidang Keahlian
          foreach ($areas as $area): ?>
              <span class="px-3 py-1 rounded-full border border-gray-300 text-sm text-gray-700 bg-white shadow-sm">
                  <?php echo htmlspecialchars($area); ?>
              </span>
          <?php endforeach; ?>
      </div>

      <div class="flex flex-wrap gap-3 mb-6">
          <?php 
          // Tautan Profil
          if (!empty($d['linkedin_link'])): ?>
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
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Jenis Kelamin</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['jenis_kelamin']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Jabatan</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['jabatan']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">TTL</div>
                <div class="flex-grow">: <?php
                    $ttl = trim((($d['tempat_lahir'] ?? '') . ((isset($d['tanggal_lahir']) && $d['tanggal_lahir'] !== '') ? ', ' . $d['tanggal_lahir'] : '')) );
                    echo htmlspecialchars($ttl ?: '-');
                ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">No. Tlp</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['telepon']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Alamat Kantor</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['alamat_kantor']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">No. Tlp / Faks</div>
                <div class="flex-grow">: <?php echo htmlspecialchars($d['telepon_faks']); ?></div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Lulusan</div>
                <div class="flex-grow">:
                    <?php
                    $lulusan_items = format_dosen_detail($d['lulusan']);
                    if (!empty($lulusan_items)):
                        $texts = array_map(function($it){ return htmlspecialchars($it['description'] ?? ($it['nama'] ?? '')); }, $lulusan_items);
                        echo ' ' . implode(', ', $texts);
                    else:
                        echo ' -';
                    endif;
                    ?>
                </div>
            </div>
            <div class="flex">
                <div class="font-semibold w-28 flex-shrink-0">Mata Kuliah</div>
                <div class="flex-grow">:
                    <?php
                    $mk_items = format_dosen_detail($d['mata_kuliah']);
                    if (!empty($mk_items)):
                        $mk_texts = array_map(function($it){ return htmlspecialchars($it['description'] ?? ($it['nama'] ?? '')); }, $mk_items);
                        echo ' ' . implode(', ', $mk_texts);
                    else:
                        echo ' -';
                    endif;
                    ?>
                </div>
            </div>
        </div>

                <!-- Pendidikan & Sertifikasi dipindahkan ke kolom kiri (di bawah foto). Duplikat dihapus. -->
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

                // Tautan jurnal default
                $jurnal_default_link = 'https://jurnal.polinema.ac.id/index.php/jip';

                $detail_link = $jurnal_default_link;

                $target = '_self';

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
                            <span class="font-semibold">DOI:</span> <a href="<?php echo $detail_link; ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($publikasi['doi']); ?></a>
                        </p>
                    <?php endif; ?>
                </div>

                <a href="<?php echo $detail_link; ?>" 
                   target="<?php echo $target; ?>"
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

    <div class="mt-12">
        <h2 class="text-2xl font-bold text-text-dark mb-6 border-b-2 border-gray-300 pb-2">Pengalaman Penelitian</h2>

        <?php if (!empty($penelitian_items)): ?>
        <ul class="space-y-6">
            <?php foreach ($penelitian_items as $penelitian): 
                $judul = htmlspecialchars($penelitian['judul'] ?? $penelitian['description'] ?? '-');
                $peran = htmlspecialchars($penelitian['peran'] ?? '-');
                $tahun = htmlspecialchars($penelitian['tahun'] ?? '-');
                $detail = htmlspecialchars($penelitian['description'] ?? '');
            ?>
            <li class="p-4 border rounded-lg hover:bg-gray-50 transition duration-150 relative">
                <h3 class="text-lg font-semibold text-blue-800 mb-1"><?php echo $judul; ?></h3>
                <div class="text-sm text-medium space-y-1">
                    <p><span class="font-semibold">Peran:</span> <?php echo $peran; ?></p>
                    <p><span class="font-semibold">Tahun:</span> <?php echo $tahun; ?></p>
                    <?php if (!empty($detail)): ?>
                    <p><span class="font-semibold">Detail:</span> <?php echo $detail; ?></p>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="text-medium italic">Belum ada pengalaman penelitian yang dicatat.</p>
        <?php endif; ?>

        <h2 class="text-2xl font-bold text-text-dark my-6 border-b-2 border-gray-300 pb-2">Pengabdian Masyarakat</h2>

        <?php if (!empty($pengabdian_items)): ?>
        <ul class="space-y-6">
            <?php foreach ($pengabdian_items as $pengabdian): 
                $judul = htmlspecialchars($pengabdian['judul'] ?? $pengabdian['description'] ?? '-');
                $peran = htmlspecialchars($pengabdian['peran'] ?? '-');
                $tahun = htmlspecialchars($pengabdian['tahun'] ?? '-');
                $detail = htmlspecialchars($pengabdian['description'] ?? '');
            ?>
            <li class="p-4 border rounded-lg hover:bg-gray-50 transition duration-150 relative">
                <h3 class="text-lg font-semibold text-blue-800 mb-1"><?php echo $judul; ?></h3>
                <div class="text-sm text-medium space-y-1">
                    <p><span class="font-semibold">Peran:</span> <?php echo $peran; ?></p>
                    <p><span class="font-semibold">Tahun:</span> <?php echo $tahun; ?></p>
                    <?php if (!empty($detail)): ?>
                    <p><span class="font-semibold">Detail:</span> <?php echo $detail; ?></p>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="text-medium italic">Belum ada pengabdian masyarakat yang dicatat.</p>
        <?php endif; ?>
    </div>

  </div>
</section>

<?php
include '../includes/footer.php';
?>