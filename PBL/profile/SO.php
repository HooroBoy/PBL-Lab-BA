<?php
// Set Judul Halaman
$page_title = "Struktur Organisasi Lab Business Analytics";

// Tentukan path relatif ke folder 'includes'
// Karena file ini ada di 'profile/', kita harus mundur satu level (..)
include '../includes/header.php';
?>

<section class="w-full bg-white pt-16 pb-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center leading-snug">
            Struktur Organisasi
        </h1>
        
        <div class="flex justify-center">
            <div class="w-full lg:w-full p-4 md:p-8 bg-white rounded-xl shadow-2xl border border-gray-200">
                
                <h2 class="text-2xl font-bold text-center text-primary mb-6">
                    Bagan Laboratorium Business Analytics (LBA)
                </h2>
                
                <div class="flex justify-center overflow-x-auto p-4">
                    <img src="../assets/Logo/Bagan.png" 
                         alt="Bagan Struktur Organisasi Laboratorium Business Analytics" 
                         class="max-w-full h-auto"
                         onerror="this.onerror=null; this.src='https://placehold.co/1000x500?text=Struktur+Organisasi';" />
                    </div>
                
                <p class="mt-8 text-center text-medium text-sm">
                    Struktur ini terdiri dari Kepala Laboratorium, Sekretaris, Bendahara, dan Koordinator Bidang, mencerminkan tata kelola profesional dan terorganisir.
                </p>

            </div>
        </div>
        </div>
</section>

<?php
// Memanggil Footer (<footer>, tag penutup)
include '../includes/footer.php';
?>