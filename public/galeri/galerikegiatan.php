<?php
// Set Judul Halaman
$page_title = "Galeri Kegiatan - Laboratory of Business Analytics";
// Memanggil Header (Header will include HTML setup and Navbar)
require_once '../includes/header.php';

// --- Menggunakan Model Galeri untuk Mengambil Data Dinamis ---
// Asumsi: File model Galeri.php terletak di lokasi yang dapat diakses (misalnya, di folder ../app/models/)
require_once __DIR__ . '/../../app/models/Galeri.php';

// Mengambil semua data galeri dengan kategori 'activity' ('aktivitas')
try {
    // Memanggil Galeri::all() dan memberikan kategori 'aktivitas' (yang di-resolve menjadi 'activity' di model)
    $activities = Galeri::all('aktivitas');
} catch (PDOException $e) {
    // Tangani kesalahan jika koneksi database gagal atau tabel tidak ditemukan
    $activities = []; // Set array kosong untuk menghindari error loop
    echo "<p class='text-center text-red-600'>Gagal memuat kegiatan dari database: Pastikan tabel 'galeri' sudah ada. (" . $e->getMessage() . ")</p>";
}
// --- Akhir Pengambilan Data ---

?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header dan Breadcrumb -->
        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                    </li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Galeri Kegiatan Lab
            </h1>
            <p class="text-lg text-medium">
                Lihat momen-momen terbaik dari workshop, seminar, dan kolaborasi riset kami.
            </p>
        </header>

        <!-- Gallery Grid -->
        <?php if (!empty($activities)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php foreach ($activities as $activity): ?>
                    <div
                        class="group bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-[1.02] border border-gray-200">
                        <!-- Foto Kegiatan -->
                        <div class="relative overflow-hidden">
                            <img class="w-full h-56 object-cover transition duration-500 group-hover:opacity-90"
                                src="/PBL-Lab-BA/public/<?php echo htmlspecialchars($activity['gambar']); ?>"
                                alt="<?php echo htmlspecialchars($activity['judul']); ?>"
                                onerror="this.onerror=null; this.src='https://placehold.co/500x350/ECF2FB/124874?text=Image+Not+Found';" />
                            <!-- Overlay Tanggal (Menggunakan created_at sebagai simulasi tanggal) -->
                            <div
                                class="absolute top-3 right-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                <?php echo date('d F Y', strtotime($activity['created_at'])); ?>
                            </div>
                        </div>

                        <!-- Keterangan Kegiatan -->
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-text-dark group-hover:text-primary transition duration-150">
                                <?php echo htmlspecialchars($activity['judul']); ?>
                            </h3>

                            <p class="text-sm text-medium leading-relaxed">
                                <?php echo htmlspecialchars($activity['deskripsi']); ?>
                            </p>


                            <div class="flex items-center text-sm font-medium text-primary pt-2">
                                <?php
                                $kategori = strtolower($activity['kategori']);
                                if ($kategori === 'activity' || $kategori === 'aktivitas') {
                                    // Icon event/aktivitas
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>';
                                } else {
                                    // Icon fasilitas/building
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2M16 3.13a4 4 0 01.94 7.76M12 7v4m0 0v4m0-4h4m-4 0H8" /></svg>';
                                }
                                ?>
                                <span><?php echo "Kategori: " . htmlspecialchars($activity['kategori']); ?></span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <p class="text-center text-lg text-medium">Belum ada kegiatan yang tersedia saat ini.</p>
        <?php endif; ?>
    </div>
    
    <div class="flex justify-center mt-8">
        <a href="../index.php" class="px-5 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>