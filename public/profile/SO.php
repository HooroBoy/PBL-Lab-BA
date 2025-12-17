<?php
$page_title = "Struktur Organisasi Laboratory of Business Analytics";

include '../includes/header.php';
?>

<section class="w-full bg-white pt-16 pb-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 text-center">
        <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="../index.php" class="text-primary hover:text-blue-700">Home</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </li>
                    <li class="text-primary">Struktur Organisasi</li>
                </ol>
            </nav>
        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center leading-snug">
            Struktur Organisasi
        </h1>
        
        <div class="flex justify-center">
            <div class="w-full lg:w-full p-4 md:p-8 bg-white rounded-xl shadow-2xl border border-gray-200">
                
                <h2 class="text-2xl font-bold text-center text-primary mb-6">
                    Bagan Laboratorium Business Analytics (LBA)
                </h2>
                
                <div class="flex justify-center overflow-x-auto p-4">
                    <img src="../assets/Logo/bagan-lab-ba.svg" 
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

    <div class="flex justify-center mt-8">
        <a href="../index.php" class="px-5 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</section>


<?php
include '../includes/footer.php';
?>