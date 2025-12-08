<?php
// FILE: pages/publikasi.php

// Set Judul Halaman
$page_title = "Daftar Publikasi - Laboratory of Business Analytics";
// Memanggil Header (Header akan di-require_once, path relatif tetap dipertahankan)
require_once '../includes/header.php'; 

// --- DEKLARASI DATA STATIS (Non-Dinamis) ---
$publikasi_list_semua = [ // Ubah nama variabel menjadi publikasi_list_semua
    [
        'id' => 1,
        'judul' => 'Model Prediksi Curah Hujan Menggunakan Deep Learning untuk Pertanian Cerdas',
        'jenis_publikasi' => 'Jurnal Ilmiah',
        'penulis' => ['Dr. Rina Sari, S.Kom., M.T.', 'Budi Santoso, S.T., M.Kom.'],
        'tanggal' => '2023-11-15',
        'tahun' => '2023', // Tambahkan kolom tahun untuk filtering
        'thumbnail' => '../assets/images/publikasi/jurnal-ai.jpg'
    ],
    [
        'id' => 2,
        'judul' => 'Analisis Sentimen Media Sosial terhadap Layanan Publik: Pendekatan Text Mining',
        'jenis_publikasi' => 'Prosiding Konferensi',
        'penulis' => ['Arif Rahman, M.Kom.', 'Siti Aisyah, M.T.'],
        'tanggal' => '2023-09-01',
        'tahun' => '2023', // Tambahkan kolom tahun untuk filtering
        'thumbnail' => '../assets/images/publikasi/prosiding-sentiment.jpg'
    ],
    [
        'id' => 3,
        'judul' => 'Penerapan Business Intelligence untuk Optimasi Rantai Pasok UKM',
        'jenis_publikasi' => 'Laporan Riset',
        'penulis' => ['Prof. Dr. Ir. Joko Susilo'],
        'tanggal' => '2024-07-20',
        'tahun' => '2024', // Tambahkan kolom tahun untuk filtering
        'thumbnail' => '../assets/images/publikasi/laporan-bi.jpg'
    ],
];
// --------------------------------------------------


// --- LOGIKA FILTERING (SEARCH & FILTER) ---

// 1. Ambil input dari URL
$search_query = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';
$filter_kategori = isset($_GET['jenis']) ? trim($_GET['jenis']) : '';
$filter_tahun = isset($_GET['tahun']) ? trim($_GET['tahun']) : '';

// 2. Tentukan daftar publikasi yang akan ditampilkan
$publikasi_list_terfilter = array_filter($publikasi_list_semua, function($publikasi) use ($search_query, $filter_kategori, $filter_tahun) {
    
    // Konversi data ke string yang dapat dicari
    $judul_lower = strtolower($publikasi['judul']);
    $penulis_string = strtolower(implode(' ', $publikasi['penulis']));
    $jenis_publikasi_raw = strtolower($publikasi['jenis_publikasi']);
    $tahun_raw = $publikasi['tahun'];


    // Kriteria 1: Pencarian (Judul atau Penulis)
    $match_search = true;
    if (!empty($search_query)) {
        if (strpos($judul_lower, $search_query) === false && strpos($penulis_string, $search_query) === false) {
            $match_search = false;
        }
    }

    // Kriteria 2: Filter Jenis Publikasi
    $match_kategori = true;
    if (!empty($filter_kategori)) {
        if ($jenis_publikasi_raw !== strtolower($filter_kategori)) {
            $match_kategori = false;
        }
    }

    // Kriteria 3: Filter Tahun
    $match_tahun = true;
    if (!empty($filter_tahun)) {
        if ($tahun_raw !== $filter_tahun) {
            $match_tahun = false;
        }
    }

    return $match_search && $match_kategori && $match_tahun;
});

// Urutkan ulang array setelah filtering
$publikasi_list_terfilter = array_values($publikasi_list_terfilter);
?>

<div id="main-content" class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <header class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-primary sm:text-5xl">
                Publikasi & Hasil Riset
            </h1>
            <p class="mt-2 text-lg text-text-medium max-w-3xl mx-auto">
                Temukan hasil riset terbaru, jurnal, dan karya ilmiah dari Laboratory of Business Analytics.
            </p>
        </header>
        
        <form method="GET" action="" class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4 mb-12 p-4 bg-white shadow rounded-lg border border-gray-100">
            
            <div class="w-full md:w-1/3">
                <label for="q" class="sr-only">Cari Publikasi</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.352l3.72 3.72a.75.75 0 11-1.06 1.06l-3.72-3.72A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="q" name="q" value="<?php echo htmlspecialchars($search_query); ?>" class="block w-full rounded-md border-0 bg-gray-50 py-2.5 pl-10 pr-3 text-sm text-text-dark ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm" placeholder="Cari berdasarkan judul atau penulis...">
                </div>
            </div>

            <div class="w-full md:w-1/3">
                <label for="jenis" class="sr-only">Filter Jenis Publikasi</label>
                <select id="jenis" name="jenis" onchange="this.form.submit()" class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-sm text-text-dark ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary">
                    <option value="">Pilih Kategori Riset</option>
                    <?php 
                        $jenis_unik = array_unique(array_column($publikasi_list_semua, 'jenis_publikasi'));
                        foreach ($jenis_unik as $jenis): ?>
                        <option value="<?php echo htmlspecialchars($jenis); ?>" 
                                <?php echo ($filter_kategori === $jenis) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($jenis); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="tahun" class="sr-only">Filter Tahun</label>
                <select id="tahun" name="tahun" onchange="this.form.submit()" class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-sm text-text-dark ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary">
                    <option value="">Semua Tahun</option>
                    <?php 
                        $tahun_unik = array_unique(array_column($publikasi_list_semua, 'tahun'));
                        rsort($tahun_unik); // Urutkan tahun dari terbaru
                        foreach ($tahun_unik as $tahun): ?>
                        <option value="<?php echo htmlspecialchars($tahun); ?>" 
                                <?php echo ($filter_tahun === $tahun) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tahun); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="sr-only">Cari</button>
        </form>
        <?php if (!empty($publikasi_list_terfilter)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                
                <?php foreach ($publikasi_list_terfilter as $publikasi): 
                    // Data Statis yang akan ditampilkan
                    $image_path = $publikasi['thumbnail'];
                    $date_formatted = date('d F Y', strtotime($publikasi['tanggal']));
                    $jenis_publikasi = htmlspecialchars($publikasi['jenis_publikasi']);
                    $authors = $publikasi['penulis'];
                ?>
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 ease-in-out border border-gray-100 flex flex-col">
                        
                        <div class="h-48 overflow-hidden">
                            <img class="w-full h-full object-cover" 
                                src="<?php echo $image_path; ?>" 
                                alt="<?php echo htmlspecialchars($publikasi['judul']); ?>"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x400/124874/ffffff?text=Publikasi';">
                        </div>

                        <div class="p-6 space-y-4 flex flex-col flex-grow">
                            <span class="text-xs font-semibold uppercase tracking-wider text-white bg-primary py-1 px-3 rounded-full self-start">
                                <?php echo $jenis_publikasi; ?>
                            </span>

                            <h2 class="text-xl font-bold text-text-dark leading-snug hover:text-primary transition duration-200">
                                <a href="publikasi_detail_statis.php?id=<?php echo $publikasi['id']; ?>"> 
                                    <?php echo htmlspecialchars($publikasi['judul']); ?>
                                </a>
                            </h2>

                            <p class="text-sm text-text-medium flex-grow">
                                Penulis : <?php 
                                // Menampilkan daftar penulis statis yang dipisahkan koma
                                echo implode(', ', array_map('htmlspecialchars', $authors));
                                ?>
                            </p>

                            <p class="text-sm text-text-medium flex-grow">
                                Deskripsi... <?php 
                                ?>
                            </p>

                            <div class="pt-4 border-t border-gray-100 mt-auto flex justify-between items-center text-xs text-gray-500">
                                <span>Tanggal : <strong><?php echo $date_formatted; ?></strong></span>
                                <a href="publikasi_detail_statis.php?id=<?php echo $publikasi['id']; ?>" class="font-bold text-primary hover:text-blue-700">
                                    Detail &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        <?php else: ?>
            <div class="text-center p-10 bg-white rounded-lg shadow-lg">
                <p class="text-lg text-text-medium">❌ Tidak ada publikasi yang ditemukan sesuai kriteria pencarian Anda.</p>
                <a href="publikasi.php" class="mt-4 inline-block text-sm font-semibold text-primary hover:text-blue-700">Reset Pencarian</a>
            </div>
        <?php endif; ?>

        <div class="flex justify-center mt-8">
            <a href="../index.php" class="px-5 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php'; // Memanggil Footer
?>