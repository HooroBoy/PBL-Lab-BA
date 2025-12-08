<?php

require_once '../includes/header.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/models/Artikel.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request.");
}

$artikel = Artikel::find($id);

if (!$artikel) {
    die("Artikel tidak ditemukan.");
}

$page_title = $artikel['judul'];
?>

<section class="w-full bg-white py-12">
    <div class="max-w-5xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="text-sm mb-6">
            <a href="<?php echo BASE_URL; ?>/artikel/artikel.php" class="text-primary hover:underline">
                ← Kembali ke Artikel
            </a>
        </div>

        <!-- Judul -->
        <h1 class="text-4xl font-bold text-primary mb-4">
            <?php echo htmlspecialchars($artikel['judul']); ?>
        </h1>

        <!-- Meta info -->
        <div class="flex items-center space-x-4 text-gray-600 text-sm mb-8">
            <span>📅 <?php echo date("d M Y", strtotime($artikel['created_at'])); ?></span>
            <span>👤 <?= htmlspecialchars($artikel['admin_username']) ?></span>
            <?php if (!empty($artikel['kategori'])): ?>
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-semibold">
                    <?php echo htmlspecialchars($artikel['kategori']); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Thumbnail -->
        <div style="width: 100%; height: 280px; " class="mb-5">
            <?php if (!empty($artikel['thumbnail'])): ?>
                <img src="<?php echo BASE_URL . '/' . $artikel['thumbnail']; ?>"
                    class="rounded-xl mb-8 shadow-xl" style="object-fit: cover; width: 100%; height: 100%;">
            <?php endif; ?>
        </div>


        <!-- Konten -->
        <article class="prose max-w-none text-gray-800 leading-relaxed">
            <?php echo nl2br($artikel['isi']); ?>
        </article>

        <!-- Tombol kembali -->
        <div class="mt-10">
            <a href="<?php echo BASE_URL; ?>/artikel/artikel.php"
                class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-blue-900 transition">
                ← Kembali ke Daftar Artikel
            </a>
        </div>

    </div>
</section>

<?php include_once BASE_PATH . '/includes/footer.php'; ?>