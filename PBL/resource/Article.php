<?php
// Set Judul Halaman
$page_title = "Daftar Artikel - Laboratory of Business Analytics";
// Memanggil Header (Header will include HTML setup and Navbar)
require_once '../includes/header.php';

// --- Data Artikel (Simulasi dari Database/Array) ---
$articles = [
    [
        'title' => 'AI di Bidang Pendidikan',
        'date' => '25 November 2025',
        'author' => 'Dr. Bima Sakti',
        'description' => 'Eksplorasi penggunaan kecerdasan buatan dalam pembelajaran yang dipersonalisasi dan adaptif.',
        'image_path' => '/assets/images/articles/article-ai-education.jpg'
    ],
    [
        'title' => 'Data Analytics untuk Peningkatan Hasil Belajar',
        'date' => '18 November 2025',
        'author' => 'Prof. Angkasa Raya',
        'description' => 'Menggunakan data besar untuk mengidentifikasi pola dan intervensi demi hasil belajar yang lebih baik.',
        'image_path' => '/assets/images/articles/article-data-analytics.jpg'
    ],
    [
        'title' => 'Apa itu TEL? Pembelajaran Berbasis Teknologi',
        'date' => '10 November 2025',
        'author' => 'Lina Dewi S.Kom., M.T.',
        'description' => 'Kompromi antara pemetaan konsep semi-otomatis dan generasi konsep otomatis penuh dalam TEL.',
        'image_path' => '/assets/images/articles/article-tel.jpg'
    ],
    [
        'title' => 'Mengoptimalkan Proses Bisnis dengan Process Mining',
        'date' => '05 November 2025',
        'author' => 'Rizky Pratama',
        'description' => 'Studi kasus implementasi Process Mining untuk efisiensi alur kerja di sektor layanan.',
        'image_path' => '/assets/images/articles/article-process-mining.jpg'
    ],
    [
        'title' => 'Peran Cloud Computing dalam Data Warehouse Modern',
        'date' => '29 Oktober 2025',
        'author' => 'Sinta Amelia',
        'description' => 'Bagaimana AWS, Azure, dan GCP mendukung kebutuhan skalabilitas data analytics saat ini.',
        'image_path' => '/assets/images/articles/article-cloud.jpg'
    ],
    [
        'title' => 'Tren Terbaru dalam Data Storytelling',
        'date' => '22 Oktober 2025',
        'author' => 'Bambang Irawan',
        'description' => 'Cara efektif mengomunikasikan insight data kepada audiens non-teknis melalui narasi.',
        'image_path' => '/assets/images/articles/article-storytelling.jpg'
    ],
];
?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header dan Breadcrumb -->
        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Koleksi Artikel Kami
            </h1>
            <p class="text-lg text-medium">
                Wawasan terbaru seputar Business Analytics, NLP, dan Inovasi Teknologi dari tim Lab.
            </p>
        </header>

        <!-- Article Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php foreach ($articles as $article): ?>
                <a href="#" class="group bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-[1.02] border border-gray-200">
                    <!-- Foto Artikel -->
                    <div class="relative overflow-hidden">
                        <img class="w-full h-56 object-cover transition duration-500 group-hover:opacity-90" 
                             src="<?php echo $article['image_path']; ?>" 
                             alt="<?php echo $article['title']; ?>"
                             onerror="this.onerror=null; this.src='https://placehold.co/500x350/ECF2FB/124874?text=<?php echo urlencode('Artikel ' . $article['title']); ?>';"
                        />
                        <!-- Overlay Tanggal -->
                        <div class="absolute top-3 right-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                            <?php echo $article['date']; ?>
                        </div>
                    </div>
                    
                    <!-- Keterangan Artikel -->
                    <div class="p-6 space-y-3">
                        <h3 class="text-xl font-bold text-text-dark group-hover:text-primary transition duration-150">
                            <?php echo $article['title']; ?>
                        </h3>
                        
                        <p class="text-sm text-medium leading-relaxed h-12 overflow-hidden">
                            <?php echo $article['description']; ?>
                        </p>

                        <div class="flex items-center text-sm font-medium text-gray-500 pt-2">
                             <!-- Author -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                             <span><?php echo $article['author']; ?></span>
                        </div>
                        
                        <!-- Link Read More -->
                        <div class="text-sm font-semibold text-primary flex items-center pt-3 hover:underline">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>