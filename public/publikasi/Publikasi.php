<?php
// FILE: pages/publikasi.php

// Set Judul Halaman
$page_title = "Daftar Publikasi - Laboratory of Business Analytics";
// Memanggil Header 
require_once '../includes/header.php'; 

// --- IMPOR MODEL DINAMIS ---
// Path disesuaikan: file Publikasi.php ada di '../app/models/Publikasi.php'
require_once "" . __DIR__ . '/../../app/models/Publikasi.php'; 

// --- DEKLARASI DATA DINAMIS ---
$publikasi_list_semua = [];

try {
    // 1. Ambil data relasi publikasi dan penulis menggunakan method 'all()' (BUKAN getAll)
    $publikasi_terstruktur = Publikasi::all(); 

    // 2. Transformasi data dari relasional menjadi flat structure
    foreach ($publikasi_terstruktur as $p_item) {
        $id = $p_item['id_publikasi'];
        
        // Ambil detail publikasi yang hilang (tahun, thumbnail) dari DB menggunakan Publikasi::find()
        // Ini dilakukan karena method all() di Publikasi.php hanya mengambil data relasi penulis
        $details = Publikasi::find($id); 

        // Flatten array penulis: ['Dr. Rina Sari, S.Kom., M.T.', 'Budi Santoso, S.T., M.Kom.']
        $penulis_array = array_column($p_item['dosen'], 'nama_dosen');

        // Rekonstruksi struktur data yang dibutuhkan oleh logika filter
        // Menggunakan 'tahun_terbit' sebagai 'tahun'
        $tahun_terbit = $details['tahun_terbit'] ?? 'N/A';
        // Asumsi: Kita membuat tanggal dengan tahun_terbit untuk keperluan sorting (misal 1 Januari tahun tersebut)
        $tanggal_asumsi = $tahun_terbit !== 'N/A' ? $tahun_terbit . '-01-01' : '1900-01-01'; 

            $publikasi_list_semua[] = [
                'id' => $id,
                'judul' => $p_item['judul'],
                'kategori_riset' => $p_item['kategori_nama'] ?? '', // kategori riset dari join
                'jenis_publikasi' => $p_item['jenis_publikasi'] ?? '', // plain text
                'penulis' => $penulis_array,
                'tanggal' => $tanggal_asumsi, 
                'tahun' => $tahun_terbit,
                'thumbnail' => $details['thumbnail'] ?? '../assets/images/publikasi/default.jpg'
            ];
    }
    
    // Urutkan daftar publikasi berdasarkan tanggal (terbaru pertama)
    usort($publikasi_list_semua, function($a, $b) {
        return strtotime($b['tanggal']) - strtotime($a['tanggal']);
    });

} catch (Exception $e) {
    // Fallback jika ada masalah koneksi DB atau model
    $publikasi_list_semua = [];
    // Anda bisa mengaktifkan baris ini untuk debugging: echo "Error loading publications: " . $e->getMessage();
}
// --------------------------------------------------


// --- LOGIKA FILTERING (SEARCH & FILTER) ---

// 1. Ambil input dari URL
$search_query = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';
$filter_kategori = isset($_GET['jenis']) ? trim($_GET['jenis']) : '';
$filter_tahun = isset($_GET['tahun']) ? trim($_GET['tahun']) : '';
$filter_dosen = isset($_GET['dosen']) ? trim($_GET['dosen']) : '';

// --- KUMPULKAN DAN OLAH DATA UNIK UNTUK FILTER DOSEN ---
$semua_penulis = [];
foreach ($publikasi_list_semua as $publikasi) {
    // Ambil semua penulis dari setiap publikasi, pastikan itu array
    if (isset($publikasi['penulis']) && is_array($publikasi['penulis'])) {
        $semua_penulis = array_merge($semua_penulis, $publikasi['penulis']);
    }
    // Ambil semua kategori riset
    if (!empty($publikasi['kategori_riset'])) {
        $semua_kategori_riset[] = $publikasi['kategori_riset'];
    }
}
// Dapatkan daftar dosen unik dan urutkan secara alfabetis
$dosen_unik = array_unique($semua_penulis);
sort($dosen_unik);
// Dapatkan daftar kategori riset unik dan urutkan
$kategori_riset_unik = array_unique($semua_kategori_riset);
sort($kategori_riset_unik);
// --------------------------------------------------------

// 2. Tentukan daftar publikasi yang akan ditampilkan
$publikasi_list_terfilter = array_filter($publikasi_list_semua, function($publikasi) use ($search_query, $filter_kategori, $filter_tahun, $filter_dosen) {
    
    // Konversi data ke string yang dapat dicari (pastikan 'penulis' adalah array)
    $judul_lower = strtolower($publikasi['judul']);
    $penulis_array = isset($publikasi['penulis']) && is_array($publikasi['penulis']) ? $publikasi['penulis'] : [];
    $penulis_string = strtolower(implode(' ', $penulis_array));
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
        if ((string)$tahun_raw !== $filter_tahun) { 
            $match_tahun = false;
        }
    }

    // Kriteria 4: Filter Dosen
    $match_dosen = true;
    if (!empty($filter_dosen)) {
        // Konversi semua nama penulis ke lowercase
        $penulis_lower = array_map('strtolower', $penulis_array);
        $filter_dosen_lower = strtolower($filter_dosen);

        // Cek apakah nama dosen yang difilter ada di dalam array penulis publikasi
        if (!in_array($filter_dosen_lower, $penulis_lower)) {
            $match_dosen = false;
        }
    }

    return $match_search && $match_kategori && $match_tahun && $match_dosen;
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
            
            <div class="w-full md:w-1/4">
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

            <div class="w-full md:w-1/4">
                <label for="jenis" class="sr-only">Filter Jenis Publikasi</label>
                <select id="jenis" name="jenis" onchange="this.form.submit()" class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-sm text-text-dark ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary">
                    <option value="">Pilih Kategori Riset</option>
                    <?php 
                        // Ambil jenis unik
                        $jenis_unik = array_unique(array_column($publikasi_list_semua, 'jenis_publikasi'));
                        foreach ($jenis_unik as $jenis): 
                            if (empty($jenis)) continue;
                    ?>
                        <option value="<?php echo htmlspecialchars($jenis); ?>" 
                                <?php echo ($filter_kategori === $jenis) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($jenis); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-1/4">
                <label for="tahun" class="sr-only">Filter Tahun</label>
                <select id="tahun" name="tahun" onchange="this.form.submit()" class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-sm text-text-dark ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary">
                    <option value="">Semua Tahun</option>
                    <?php 
                        // Ambil tahun unik
                        $tahun_unik = array_unique(array_column($publikasi_list_semua, 'tahun'));
                        $tahun_unik = array_filter($tahun_unik); 
                        rsort($tahun_unik); 
                        foreach ($tahun_unik as $tahun): ?>
                        <option value="<?php echo htmlspecialchars($tahun); ?>" 
                                <?php echo ((string)$filter_tahun === (string)$tahun) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tahun); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-1/4">
                <label for="dosen" class="sr-only">Filter Dosen</label>
                <select id="dosen" name="dosen" onchange="this.form.submit()" class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-sm text-text-dark ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary">
                    <option value="">Dosen</option>
                    <?php 
                        // Menggunakan $dosen_unik
                        foreach ($dosen_unik as $dosen): 
                            if (empty($dosen)) continue;
                    ?>
                        <option value="<?php echo htmlspecialchars($dosen); ?>" 
                                <?php echo ($filter_dosen === $dosen) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($dosen); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="sr-only">Cari</button>
        </form>
        <?php if (!empty($publikasi_list_terfilter)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                
                <?php foreach ($publikasi_list_terfilter as $publikasi): 
                    // Data Dinamis
                    $image_path = htmlspecialchars($publikasi['thumbnail'] ?? '../assets/images/publikasi/default.jpg'); 
                    // Tampilkan tanggal atau tahun jika tanggal penuh tidak tersedia
                    $date_formatted = isset($publikasi['tanggal']) && $publikasi['tanggal'] !== '1900-01-01' ? date('d F Y', strtotime($publikasi['tanggal'])) : 'Tahun ' . htmlspecialchars($publikasi['tahun'] ?? 'N/A');
                    $jenis_publikasi = htmlspecialchars($publikasi['jenis_publikasi'] ?? 'Lainnya');
                    $authors = isset($publikasi['penulis']) && is_array($publikasi['penulis']) ? $publikasi['penulis'] : [];
                ?>
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 ease-in-out border border-gray-100 flex flex-col">
                        
                        <div class="h-48 overflow-hidden">
                            <?php 
                                // Tentukan teks yang akan menjadi judul di placeholder jika thumbnail gagal/kosong
                                $placeholder_text = !empty($jenis_publikasi) ? $jenis_publikasi : 'Publikasi';
                                $placeholder_url = 'https://placehold.co/600x400/124874/ffffff?text=' . urlencode($placeholder_text);
                            ?>
                            <img class="w-full h-full object-cover" 
                                src="<?php echo $image_path; ?>" 
                                alt="<?php echo htmlspecialchars($publikasi['judul'] ?? $placeholder_text); ?>"
                                onerror="this.onerror=null; this.src='<?php echo $placeholder_url; ?>';">
                        </div>

                        <div class="p-6 space-y-4 flex flex-col flex-grow">
                            <span class="text-xs font-semibold uppercase tracking-wider text-white bg-primary py-1 px-3 rounded-full self-start">
                                <?php echo $jenis_publikasi; ?>
                            </span>

                            <h2 class="text-xl font-bold text-text-dark leading-snug hover:text-primary transition duration-200 flex-grow">
                                <a href="publikasi_detail.php?id=<?php echo htmlspecialchars($publikasi['id'] ?? 0); ?>"> 
                                    <?php echo htmlspecialchars($publikasi['judul'] ?? 'Judul Tidak Tersedia'); ?>
                                </a>
                            </h2>

                            <p class="text-sm text-text-medium">
                                Penulis : <?php 
                                echo implode(', ', array_map('htmlspecialchars', $authors));
                                ?>
                            </p>
                            
                            <p class="text-sm text-text-medium flex-grow"></p>
                            <p class="text-sm text-text-medium flex-grow">
                                Deskripsi
                            </p>

                            <div class="pt-4 border-t border-gray-100 mt-auto flex justify-between items-center text-xs text-gray-500">
                                <span>Tahun : <strong><?php echo htmlspecialchars($publikasi['tahun'] ?? 'N/A'); ?></strong></span>
                                <a href="publikasi_detail.php?id=<?php echo htmlspecialchars($publikasi['id'] ?? 0); ?>" class="font-bold text-primary hover:text-blue-700">
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