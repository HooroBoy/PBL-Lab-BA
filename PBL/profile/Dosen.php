<?php

$page_title = 'Daftar Dosen';

// --- Embedded data (previously in dosen_data.php) ---
$dosenList = [
    '0005078102' => [
        'name' => 'Ahmadi Yuli Ananta, S.T., M.M.',
        'nidn' => '0005078102',
        'nip' => '198107052005011002',
        'title' => 'Tenaga Pengajar',
        'image' => '../assets/ImageDosen/ahmadi_yuli.jpg',
        'study' => 'Sistem Informasi Bisnis',
        'email' => 'ahmadi@polinema.ac.id',
        'education' => [
            'S2 — Magister Manajemen, Universitas Gajayana (2017)',
            'S1 — Sarjana Teknik, Universitas Islam Indonesia (2004)'
        ],
        'certifications' => [],
        'areas' => ['Sistem Informasi', 'Data Science', 'Networking']
    ],
    '0010028903' => [
        'name' => 'Agung Nugroho Pramudhita, S.T., M.T.',
        'nidn' => '0010028903',
        'nip' => '197912132003121001',
        'title' => 'Tenaga Pengajar',
        'image' => '../assets/ImageDosen/agung_nugroho.jpg',
        'study' => 'Teknik Informatika',
        'email' => 'agung@polinema.ac.id',
        'education' => [
            'S2 — Magister Teknologi Informasi, Univ. Indonesia (2015)',
            'S1 — Sarjana Teknik, ITS (2000)'
        ],
        'certifications' => [],
        'areas' => ['AI', 'Machine Learning']
    ],
    '0404079101' => [
        'name' => 'Ade Ismail, S.Kom., M.TI',
        'nidn' => '0404079101',
        'nip' => '197805052004121001',
        'title' => 'Tenaga Pengajar',
        'image' => '../assets/ImageDosen/ade_ismail.jpg',
        'study' => 'Sistem Informasi',
        'email' => 'ade@polinema.ac.id',
        'education' => [
            'S2 — Magister Teknologi Informasi, Univ. Brawijaya (2016)',
            'S1 — Sarjana Komputer, Univ. Negeri Malang (2002)'
        ],
        'certifications' => [],
        'areas' => ['Information Systems']
    ],
];

function dosen_image_or_placeholder($path) {
    $candidate = __DIR__ . DIRECTORY_SEPARATOR . str_replace('../', '', $path);
    if (file_exists($candidate)) return $path;
    return '../assets/ImageDosen/default-avatar.png';
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php foreach ($dosenList as $nidn => $d):
        $img = dosen_image_or_placeholder($d['image']);
      ?>
        <a href="LihatDosen.php?nidn=<?php echo urlencode($nidn); ?>" class="block bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition">
          <div class="flex flex-col items-center text-center">
            <div class="w-40 h-40 rounded-lg overflow-hidden mb-4">
              <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($d['name']); ?>" class="w-full h-full object-cover" />
            </div>
            <h3 class="text-lg font-semibold text-text-dark mb-1"><?php echo htmlspecialchars($d['name']); ?></h3>
            <div class="text-sm text-medium">NIDN: <?php echo htmlspecialchars($d['nidn']); ?></div>
            <div class="text-sm text-medium mt-1"><?php echo htmlspecialchars($d['title']); ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
