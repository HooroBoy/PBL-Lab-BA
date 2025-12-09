<?php
$page_title = "Daftar Artikel Laboratory of Business Analytics";

require_once '../includes/header.php';

require_once __DIR__ . '/../../app/models/Artikel.php';

try {
    $articles = Artikel::all();
} catch (PDOException $e) {
    $articles = []; 
    echo "<p class='text-center text-red-600'>Gagal memuat artikel dari database: " . $e->getMessage() . "</p>";
}

?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header dan Breadcrumb -->
        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="/index.php" class="text-primary hover:text-blue-700">Home</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li class="text-primary">Artikel</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Artikel Kami
            </h1>
            <p class="text-lg text-medium">
                Wawasan terbaru seputar Business Analytics, NLP, dan Inovasi Teknologi dari tim Lab.
            </p>
        </header>

        <!-- Article Grid -->
        <?php if (!empty($articles)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php foreach ($articles as $article): ?>
                    <a href="/PBL-Lab-BA/public/artikel/detail.php?id=<?php echo $article['id']; ?>"
                        class="group bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-[1.02] border border-gray-200">
                        <!-- Foto Artikel -->
                        <div class="relative overflow-hidden">
                            <img class="w-full h-56 object-cover transition duration-500 group-hover:opacity-90"
                                src="/PBL-Lab-BA/public/<?php echo htmlspecialchars($article['thumbnail']); ?>"
                                alt="<?php echo htmlspecialchars($article['judul']); ?>"
                                onerror="this.onerror=null; this.src='https://placehold.co/500x350/ECF2FB/124874?text=<?php echo urlencode('Artikel ' . $article['judul']); ?>';" />
                            <!-- Overlay Tanggal -->
                            <div
                                class="absolute top-3 right-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                <?php echo date('d F Y', strtotime($article['tanggal'])); ?>
                            </div>
                        </div>

                        <!-- Keterangan Artikel -->
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-text-dark group-hover:text-primary transition duration-150">
                                <?php echo htmlspecialchars($article['judul']); ?>
                            </h3>

                            <p class="text-sm text-medium leading-relaxed h-12 overflow-hidden">
                                <?php echo substr(strip_tags($article['isi']), 0, 150) . (strlen(strip_tags($article['isi'])) > 150 ? '...' : ''); ?>
                            </p>

                            <div class="flex items-center text-sm font-medium text-gray-500 pt-2">
                                <!-- Author -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-primary" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                <span>Author: <?php echo htmlspecialchars($article['nama']); ?></span>
                            </div>

                            <!-- Link Read More -->
                            <div class="text-sm font-semibold text-primary flex items-center pt-3 hover:underline">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <p class="text-center text-lg text-medium">Belum ada artikel yang tersedia saat ini.</p>
        <?php endif; ?>

    </div>
    <div class="flex justify-center mt-8">
        <a href="../index.php" class="px-5 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>