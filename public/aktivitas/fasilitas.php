<?php
// Set Judul Halaman
$page_title = "Fasilitas & Peralatan - Laboratory of Business Analytics";
// Memanggil Header
require_once '../includes/header.php';

// --- Impor Model Galeri ---
require_once '../../app/models/Galeri.php'; 

// --- Data Fasilitas Statis (Icon & Deskripsi) ---
$facilities_data = [
    [
        'title' => 'Ruang Laboratorium',
        'description' => 'Ruang laboratorium dengan perangkat komputer dan perangkat lunak analisis bisnis, mendukung praktikum, eksperimen, dan penelitian.',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 5.67a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/></svg>'
    ],
    [
        'title' => 'Tools Analisis',
        'description' => 'Akses berbagai tools pemodelan proses bisnis, analisis data, serta simulasi sistem informasi.',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>'
    ],
    [
        'title' => 'Perangkat Presentasi & Diskusi',
        'description' => 'Dilengkapi perangkat presentasi interaktif dan sarana diskusi untuk kegiatan kolaboratif.',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h18v14zm-10-8h2v2h-2zm-4-4h10V9H7z"/></svg>'
    ],
    [
        'title' => 'Jaringan Internet & Server',
        'description' => 'Jaringan internet berkecepatan tinggi serta server lokal mendukung praktikum, riset, dan kolaborasi kampus.',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v3h-4v-3H8l4-4 4 4h-2z"/></svg>'
    ]
];

// --- Ambil Data Galeri Fasilitas DARI DATABASE ---
try {
    $gallery_photos = Galeri::all('fasilitas');
} catch (Exception $e) {
    $gallery_photos = []; 
}
?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="/index.php" class="text-primary hover:text-blue-700">Home</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </li>
                    <li class="text-primary">Fasilitas</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Fasilitas & Peralatan
            </h1>
            <p class="text-lg text-medium">
                Sarana pendukung utama untuk riset, praktikum, dan proyek Business Analytics.
            </p>
        </header>

        <?php if (!empty($gallery_photos)): ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($gallery_photos as $photo): 
                    // --- PERBAIKAN LOGIKA PATH GAMBAR ---
                    $raw_path = $photo['gambar'];

                    // 1. Bersihkan path jika database menyimpan 'assets/fasilitas/nama.jpg'
                    // Kita hapus folder path agar kita bisa menyusun ulang dengan benar
                    $clean_filename = str_replace(['assets/fasilitas/', 'assets/fasilitas\\'], '', $raw_path);
                    $clean_filename = ltrim($clean_filename, '/');

                    // 2. Susun path lengkap dengan nama folder project
                    // Pastikan folder ini benar: /PBL-Lab-BA/public/assets/fasilitas/
                    $final_src = '/PBL-Lab-BA/public/assets/fasilitas/' . $clean_filename;
                ?>
                    <div class="relative overflow-hidden rounded-xl shadow-md group">
                        <img class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110" 
                             src="<?php echo $final_src; ?>" 
                             alt="<?php echo htmlspecialchars($photo['judul']); ?>"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x300/124874/FFFFFF?text=Image+Error';"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80 flex items-end p-3 md:p-4">
                            <p class="text-white text-xs md:text-sm font-semibold"><?php echo htmlspecialchars($photo['judul']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                <p class="text-gray-500">Tidak ada foto fasilitas yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-10">
            <?php foreach ($facilities_data as $facility): ?>
                <div class="block bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6 space-y-4 flex flex-col h-full">
                        <div class="w-12 h-12 p-3 rounded-full bg-blue-50 text-primary flex items-center justify-center border border-blue-100">
                            <?php echo $facility['icon_svg']; ?>
                        </div>
                        
                        <h3 class="text-xl font-bold text-text-dark leading-snug">
                            <?php echo $facility['title']; ?>
                        </h3>
                        <p class="text-sm text-gray-600 flex-grow leading-relaxed">
                            <?php echo $facility['description']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-center w-full mt-12 pt-8 border-t border-gray-100">
            <a href="/resources/facilities-borrowing.php" class="px-8 py-3 text-sm font-bold bg-primary text-white rounded-full shadow-lg hover:bg-blue-800 transition duration-300 transform hover:-translate-y-1">
                Ajukan Peminjaman Fasilitas
            </a>
        </div>

    </div>
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>