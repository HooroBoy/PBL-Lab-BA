<?php
// Set Judul Halaman
$page_title = "Fokus Riset Lab Business Analytics";

// Tentukan path relatif ke folder 'includes'
// Karena file ini ada di 'profile/', kita harus mundur satu level (..)
include '../includes/header.php';
?>

<section class="w-full bg-white pt-16 pb-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center leading-snug">
            Fokus Riset
        </h1>

        <div class="flex justify-center">
            <div class="w-full lg:w-4/5 p-6 md:p-10 border-4 border-primary rounded-xl shadow-lg space-y-6">
                
                <p class="text-lg text-medium leading-relaxed">
                    Laboratorium Business Analytics berfokus pada pengembangan solusi cerdas dan model analitik terapan yang dapat diimplementasikan dalam berbagai sektor industri. Fokus riset kami terbagi dalam beberapa pilar utama:
                </p>
                
                <h2 class="text-3xl font-bold text-primary pb-2 border-b border-primary">
                    Pilar Utama Riset
                </h2>
                
                <ol class="list-decimal list-outside space-y-4 pl-5 text-lg text-medium leading-relaxed">
                    <li>
                        Predictive & Prescriptive Analytics: Pengembangan model peramalan (forecasting), optimasi, dan simulasi untuk mendukung pengambilan keputusan yang proaktif di bisnis.
                    </li>
                    <li>
                        Big Data & Data Engineering: Penelitian mengenai infrastruktur, pemrosesan, dan manajemen data skala besar (Big Data) untuk mendukung aplikasi Business Analytics.
                    </li>
                    <li>
                        Business Intelligence (BI) & Visual Analytics: Fokus pada pembuatan dasbor interaktif, visualisasi data yang efektif, dan alat pelaporan BI untuk pemahaman bisnis yang mendalam.
                    </li>
                    <li>
                        Machine Learning (ML) in Business: Penerapan algoritma ML (seperti klasifikasi, clustering, dan regresi) untuk memecahkan masalah bisnis spesifik, seperti deteksi *fraud* dan segmentasi pelanggan.
                    </li>
                    <li>
                        AI & Natural Language Processing (NLP) for Industry: Eksplorasi penggunaan kecerdasan buatan dan NLP untuk analisis sentimen dari data teks (misalnya ulasan pelanggan) dan otomatisasi layanan.
                    </li>
                </ol>
                
                <p class="pt-4 text-medium text-sm italic">
                    Setiap pilar riset dirancang untuk menghasilkan prototipe yang siap pakai dan dapat memberikan dampak nyata bagi transformasi digital mitra industri.
                </p>

            </div>
        </div>

    </div>
</section>

<?php
// Memanggil Footer (<footer>, tag penutup)
include '../includes/footer.php';
?>