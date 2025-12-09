<?php

require_once dirname(__DIR__, 2) . '/app/models/Galeri.php'; 

$page_title = "Fasilitas & Peralatan Laboratory of Business Analytics";
require_once '../includes/header.php';

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

// Data Galeri Foto
$gallery_photos = Galeri::all('fasilitas');

$upload_base_url = '../assets/fasilitas/'; 
?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="../index.php" class="text-primary hover:text-blue-700">Home</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
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

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <?php if (!empty($gallery_photos)): ?>
                <?php foreach ($gallery_photos as $photo): ?>
                    <?php 
                        if (filter_var($photo['gambar'], FILTER_VALIDATE_URL)) {
                            $img_src = $photo['gambar'];
                        } elseif (strpos($photo['gambar'], 'assets/fasilitas/') === 0) {
                            $img_src = '../' . $photo['gambar'];
                        } else {
                            $img_src = $upload_base_url . $photo['gambar'];
                        }
                    ?>
                    <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer transition-transform duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <img class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" 
                             src="<?php echo htmlspecialchars($img_src); ?>" 
                             alt="<?php echo htmlspecialchars($photo['judul']); ?>"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x300/124874/FFFFFF?text=No+Image';"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity flex items-end p-3 md:p-4">
                            <div>
                                <p class="text-white text-sm font-bold translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                    <?php echo htmlspecialchars($photo['judul']); ?>
                                </p>
                                <?php if(!empty($photo['deskripsi'])): ?>
                                    <p class="text-gray-200 text-xs mt-1 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 delay-75 line-clamp-2">
                                        <?php echo htmlspecialchars($photo['deskripsi']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-10 text-gray-500">
                    <p>Belum ada foto fasilitas yang diunggah.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-10">
            <?php foreach ($facilities_data as $facility): ?>
                <div class="block bg-white rounded-xl shadow-lg border border-gray-200 transform transition duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-200 h-full group">
                    <div class="p-6 space-y-6 flex flex-col h-full">
                        <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-blue-100 transition-colors">
                            <?php echo $facility['icon_svg']; ?>
                        </div>
                        
                        <h3 class="text-xl font-bold text-text-dark leading-snug">
                            <?php echo $facility['title']; ?>
                        </h3>
                        <p class="text-sm text-medium flex-grow">
                            <?php echo $facility['description']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>  

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