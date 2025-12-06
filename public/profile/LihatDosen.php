<?php
define('DOSEN_DATA_ONLY', true);
require_once __DIR__ . '/Dosen.php';

$nidn = isset($_GET['nidn']) ? $_GET['nidn'] : null;
if (!$nidn || !isset($dosenList[$nidn])) {
    // simple fallback: show list link and message
    include '../includes/header.php';
    echo '<section class="max-w-4xl mx-auto p-8"><h2 class="text-2xl font-bold">Dosen tidak ditemukan</h2><p><a class="text-primary" href="Dosen.php">Kembali ke Daftar Dosen</a></p></section>';
    include '../includes/footer.php';
    exit;
}

$d = $dosenList[$nidn];
include '../includes/header.php';
?>

<section class="w-full bg-white pt-12 pb-20">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-start md:space-x-8">
      <div class="w-40 md:w-48 mb-6 md:mb-0">
        <img src="<?php echo htmlspecialchars(dosen_image_or_placeholder($d['image'])); ?>" alt="<?php echo htmlspecialchars($d['name']); ?>" class="w-full h-full object-cover rounded-lg border-4 border-primary" />
      </div>
      <div class="flex-1">
        <h1 class="text-2xl font-extrabold text-text-dark mb-1"><?php echo htmlspecialchars($d['name']); ?></h1>
        <div class="text-sm text-medium mb-4">NIP: <?php echo htmlspecialchars($d['nip']); ?> &nbsp; | &nbsp; NIDN: <?php echo htmlspecialchars($d['nidn']); ?></div>

        <div class="mb-6">
          <?php if (!empty($d['areas'])): ?>
            <div class="flex flex-wrap gap-2 mb-3">
              <?php foreach ($d['areas'] as $area): ?>
                <span class="px-3 py-1 rounded-full border text-sm text-text-dark bg-white"><?php echo htmlspecialchars($area); ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <div class="flex items-center gap-3">
            <a class="px-3 py-1 bg-yellow-50 border rounded text-sm" href="#">LinkedIn</a>
            <a class="px-3 py-1 bg-yellow-50 border rounded text-sm" href="#">Google Scholar</a>
            <a class="px-3 py-1 bg-yellow-50 border rounded text-sm" href="#">Sinta</a>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="p-4 border rounded-lg">
            <h3 class="font-semibold mb-2">Pendidikan</h3>
            <ul class="list-disc pl-5 text-sm text-medium">
              <?php foreach ($d['education'] as $edu): ?>
                <li><?php echo htmlspecialchars($edu); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="p-4 border rounded-lg">
            <h3 class="font-semibold mb-2">Sertifikasi</h3>
            <?php if (!empty($d['certifications'])): ?>
              <ul class="list-disc pl-5 text-sm text-medium">
                <?php foreach ($d['certifications'] as $c): ?>
                  <li><?php echo htmlspecialchars($c); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <div class="text-sm text-medium">-</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include '../includes/footer.php';
?>
