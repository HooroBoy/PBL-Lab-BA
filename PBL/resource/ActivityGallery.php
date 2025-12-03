<?php
// Set Judul Halaman
$page_title = "Galeri Kegiatan - Laboratory of Business Analytics";
// Memanggil Header (Header will include HTML setup and Navbar)
require_once '../includes/header.php';

// --- Data Kegiatan (Simulasi dari Database/Array) ---
$activities = [
    [
        'title' => 'Workshop Data Visualization 2025',
        'date' => '17 September 2025',
        'location' => 'Gedung L8, Polinema',
        'description' => 'Sesi mendalam tentang teknik visualisasi data efektif menggunakan Power BI dan Tableau.',
        'image_path' => '/assets/images/galeri/workshop-1.jpg'
    ],
    [
        'title' => 'Seminar Kecerdasan Bisnis',
        'date' => '20 Agustus 2025',
        'location' => 'Aula Pertemuan',
        'description' => 'Presentasi riset terbaru tentang penerapan AI dalam pengambilan keputusan bisnis.',
        'image_path' => '/assets/images/galeri/seminar-2.jpg'
    ],
    [
        'title' => 'Diskusi Proyek Akhir Angkatan 2024',
        'date' => '10 Juli 2025',
        'location' => 'Lab Business Analytics',
        'description' => 'Sesi mentoring dan *review* proyek akhir mahasiswa di bidang Process Mining.',
        'image_path' => '/assets/images/galeri/team-meeting-3.jpg'
    ],
    [
        'title' => 'Presentasi Hasil Riset Industri',
        'date' => '05 Juni 2025',
        'location' => 'Ruang Dosen JTI',
        'description' => 'Pemaparan hasil penelitian kolaboratif dengan mitra industri tentang optimasi rantai pasok.',
        'image_path' => '/assets/images/galeri/presentation-4.jpg'
    ],
    [
        'title' => 'Hackathon Data & NLP Challenge',
        'date' => '12 Mei 2025',
        'location' => 'Lab Komputer A',
        'description' => 'Ajang kompetisi membuat solusi berbasis NLP dan Machine Learning selama 24 jam.',
        'image_path' => '/assets/images/galeri/hackathon-5.jpg'
    ],
    [
        'title' => 'Kunjungan Industri ke Perusahaan Data',
        'date' => '25 April 2025',
        'location' => 'Surabaya, Jawa Timur',
        'description' => 'Kunjungan untuk melihat langsung implementasi sistem Business Intelligence di dunia nyata.',
        'image_path' => '/assets/images/galeri/field-trip-6.jpg'
    ],
    // Tambahkan kegiatan lain di sini
    [
        'title' => 'Pelatihan Dasar Process Mining',
        'date' => '01 April 2025',
        'location' => 'Lab Business Analytics',
        'description' => 'Pelatihan dasar pemanfaatan tool Celonis untuk pemodelan dan analisis proses bisnis.',
        'image_path' => '/assets/images/galeri/workshop-2.jpg'
    ],
];
?>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header dan Breadcrumb -->
        <header class="text-center space-y-3 pb-8 border-b border-gray-200">
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Galeri Kegiatan Lab
            </h1>
            <p class="text-lg text-medium">
                Lihat momen-momen terbaik dari workshop, seminar, dan kolaborasi riset kami.
            </p>
        </header>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php foreach ($activities as $activity): ?>
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-[1.02] border border-gray-200">
                    <!-- Foto Kegiatan -->
                    <div class="relative overflow-hidden">
                        <img class="w-full h-56 object-cover transition duration-500 group-hover:opacity-90" 
                             src="<?php echo $activity['image_path']; ?>" 
                             alt="<?php echo $activity['title']; ?>"
                             onerror="this.onerror=null; this.src='https://placehold.co/500x350/ECF2FB/124874?text=<?php echo urlencode($activity['title']); ?>';"
                        />
                        <!-- Overlay Tanggal -->
                        <div class="absolute top-3 right-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                            <?php echo $activity['date']; ?>
                        </div>
                    </div>
                    
                    <!-- Keterangan Kegiatan -->
                    <div class="p-6 space-y-3">
                        <h3 class="text-xl font-bold text-text-dark group-hover:text-primary transition duration-150">
                            <?php echo $activity['title']; ?>
                        </h3>
                        
                        <p class="text-sm text-medium leading-relaxed">
                            <?php echo $activity['description']; ?>
                        </p>

                        <div class="flex items-center text-sm font-medium text-primary pt-2">
                             <!-- Lokasi Icon -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                             <span><?php echo $activity['location']; ?></span>
                        </div>
                        
                        <!-- Link Detail (Opsional) -->
                        <!-- <a href="#" class="text-sm font-semibold text-primary flex items-center pt-3 hover:underline">
                            Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a> -->
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>