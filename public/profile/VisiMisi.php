<?php
// Set Judul Halaman
$page_title = "Visi & Misi Lab Business Analytics";

// Tentukan path relatif ke folder 'includes'
// Karena file ini ada di 'profile/', kita harus mundur satu level (..)
include '../includes/header.php';
?>

<section class="w-full bg-white pt-16 pb-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center leading-snug mb-16">
            Visi & Misi Lab
        </h1>

        <!-- Visi & Misi Cards (Side-by-side) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Visi Card -->
            <div class="p-8 md:p-10 bg-blue-50 rounded-2xl shadow-md space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-text-dark">Visi Kami</h2>
                </div>
                <p class="text-lg text-medium leading-relaxed">
                    Menjadi laboratorium rujukan nasional yang unggul sebagai inkubator solusi cerdas berbasis data, yang mampu menjadi mitra strategis industri dan pemerintahan dalam mempercepat transformasi bisnis, meningkatkan kualitas pengambilan keputusan, serta menghasilkan inovasi yang berdampak bagi masyarakat.                
                </p>
            </div>

            <!-- Misi -->
            <div class="p-8 md:p-10 bg-green-50 rounded-2xl shadow-md space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-text-dark">Misi Kami</h2>
                </div>
                
                <div x-data="{ openMission: null }" class="space-y-2">
                    <!-- Misi 1 -->
                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <button @click="openMission = openMission === 1 ? null : 1" class="w-full flex items-start justify-between p-4 hover:bg-green-100 transition duration-150">
                            <div class="flex items-start space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                <span class="text-lg text-medium font-semibold text-text-dark">Mengembangkan Riset Terapan Yang Relevan</span>
                            </div>
                            <svg :class="openMission === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-green-500 flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="openMission === 1" x-transition class="px-4 pb-4 bg-green-50 border-t border-green-200 text-medium">
                            Melaksanakan riset berbasis data yang fokus pada pemecahan masalah nyata, menghasilkan purwarupa, model, dataset rujukan, dan publikasi terapan yang mendukung perkembangan ilmu dan kebutuhan industri.
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <button @click="openMission = openMission === 2 ? null : 2" class="w-full flex items-start justify-between p-4 hover:bg-green-100 transition duration-150">
                            <div class="flex items-start space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                <span class="text-lg text-medium font-semibold text-text-dark">
                                    Mengintegrasikan Berbagai Disiplin Ilmu
                                </span>
                            </div>
                            <svg :class="openMission === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-green-500 flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="openMission === 2" x-transition class="px-4 pb-4 bg-green-50 border-t border-green-200 text-medium">
                            Menghubungkan keilmuan bisnis, teknologi informasi, data science, NLP, digital marketing, dan tata kelola data untuk menciptakan proses analitik end-to-end yang komprehensif.
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <button @click="openMission = openMission === 3 ? null : 3" class="w-full flex items-start justify-between p-4 hover:bg-green-100 transition duration-150">
                            <div class="flex items-start space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                <span class="text-lg text-medium font-semibold text-text-dark">
                                    Membangun Kemitraan dengan Industri
                                </span>
                            </div>
                            <svg :class="openMission === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-green-500 flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="openMission === 3" x-transition class="px-4 pb-4 bg-green-50 border-t border-green-200 text-medium">
                            Menjalin kolaborasi jangka pendek hingga jangka panjang melalui studi kasus nyata, uji coba purwarupa, konsultasi berbasis data, program magang, dan pengembangan solusi yang dapat diimplementasikan.
                        </div>
                    </div>

                    <!-- Misi 4 -->
                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <button @click="openMission = openMission === 4 ? null : 4" class="w-full flex items-start justify-between p-4 hover:bg-green-100 transition duration-150">
                            <div class="flex items-start space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                <span class="text-lg text-medium font-semibold text-text-dark">
                                    Mengembangkan Talenta Dosen dan Mahasiswa
                                </span>
                            </div>
                            <svg :class="openMission === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-green-500 flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="openMission === 4" x-transition class="px-4 pb-4 bg-green-50 border-t border-green-200 text-medium">
                            Menyelenggarakan praktikum, pelatihan, workshop, dan sertifikasi (nasional maupun internasional) untuk meningkatkan kapasitas SDM yang unggul, adaptif, dan berdaya saing tinggi.
                        </div>
                    </div>

                    <!-- Misi 5 -->
                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <button @click="openMission = openMission === 5 ? null : 5" class="w-full flex items-start justify-between p-4 hover:bg-green-100 transition duration-150">
                            <div class="flex items-start space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                <span class="text-lg text-medium font-semibold text-text-dark">
                                    Menyelenggarakan Tata Kelola yang Profesional
                                </span>
                            </div>
                            <svg :class="openMission === 5 ? 'rotate-180' : ''" class="w-5 h-5 text-green-500 flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="openMission === 5" x-transition class="px-4 pb-4 bg-green-50 border-t border-green-200 text-medium">
                            Menerapkan standar mutu, etika penelitian, privasi data, keamanan informasi, prosedur operasional, serta pembaruan berkelanjutan terhadap sarana, perangkat lunak, dan layanan laboratorium.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center pt-10 leading-snug mb-16">
            Tujuan Laboratorium Business Analytics
        </h1>

        <!-- Tujuan Descripsi -->
        <div class="p-8 md:p-10 bg-blue-50 rounded-2xl shadow-md max-w-4xl mx-auto mb-12">
            <p class="text-lg text-medium leading-relaxed text-text-dark">
                <span class="font-bold">Laboratorium Business Analytics</span> bertujuan menjadi <span Class="font-bold">Center of Excellence</span> yang memadukan inovasi, riset terapan, pengembangan SDM, dan kemitraan industri untuk mendorong transformasi bisnis berbasis data, serta menjadi rujukan nasional dalam praktik analitik modern.
            </p>
                
            <p class="text-lg text-medium italic leading-relaxed text-text-dark mt-6">
                "Melalui riset, pengembangan produk, dan kemitraan strategis industri, kami berkomitmen untuk memberikan dampak signifikan pada transformasi bisnis berbasis data, serta menjadi rujukan nasional dalam praktik analitik dan inovasi digital yang berkelanjutan."
            </p>
        </div>

        <!-- Fokus Utama -->
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-text-dark mb-6">Fokus Utama Kami</h2>
            <div x-data="{ openFocus: null }" class="space-y-3">
                <!-- Fokus 1 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 1 ? null : 1" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Mencapai Pengakuan Nasional sebagai Laboratorium Unggul
                            </span>
                        </div>
                        <svg :class="openFocus === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 1" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Menjadi laboratorium rujukan nasional yang menyediakan proses analitik end-to-end, repositori data terkurasi, dan layanan riset/pengabdian berbasis bukti yang dapat diuji ulang.
                    </div>
                </div>

                <!-- Fokus 2 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 2 ? null : 2" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Mewujudkan Inovasi melalui Inkubasi Solusi Cerdas
                            </span>
                        </div>
                        <svg :class="openFocus === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 2" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Menghasilkan prototipe, model prediktif, sistem dashboard, pipeline ETL, dan alat analitik yang siap diuji, diimplementasikan, atau dikembangkan menjadi produk nyata.
                    </div>
                </div>

                <!-- Fokus 3 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 3 ? null : 3" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Mendorong Riset Terapan yang Relevan, Terukur, dan Reproducible
                            </span>
                        </div>
                        <svg :class="openFocus === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 3" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Melaksanakan penelitian dosen dan mahasiswa berbasis data riil, metodologi yang valid, dokumentasi yang lengkap, serta luaran berupa artikel ilmiah, HAKI, purwarupa, dan dataset rujukan.
                    </div>
                </div>

                <!-- Fokus 4 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 4 ? null : 4" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Menguatkan Kemitraan Strategis dengan Industri dan Pemerintah
                            </span>
                        </div>
                        <svg :class="openFocus === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 4" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Menyediakan platform kolaborasi berupa studi kasus, uji purwarupa, konsultasi keputusan berbasis data, dan program magang, guna meningkatkan relevansi kompetensi lulusan dan kontribusi institusi.
                    </div>
                </div>

                <!-- Fokus 5 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 5 ? null : 5" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Mengembangkan Talenta Sumber Daya Manusia (Dosen & Mahasiswa)
                            </span>
                        </div>
                        <svg :class="openFocus === 5 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 5" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Meningkatkan kualitas dan kapasitas SDM melalui:
                        <br>1. Pembelajaran berbasis proyek</br>
                        2. Sertifikasi kompetensi nasional (BNSP/SKKNI) dan global
                        <br>3. Pelatihan perangkat profesional (Power BI, Tableau, SQL, Cloud)</br>
                        4. Klinik riset dan metodologi.
                    </div>
                </div>

                <!-- Fokus 6 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 6 ? null : 6" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Memperkuat Tata Kelola, Etika, & Keamanan Data
                            </span>
                        </div>
                        <svg :class="openFocus === 6 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 6" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Menjamin operasional laboratorium dengan SOP yang mencakup:
                        <br>- Privasi data sesuai UU PDP</br>
                        - Keamanan dan manajemen hak akses
                        <br>- Standar mutu praktikum</br>
                        - Dokumentasi proses dan reproducibility
                        <br>- Audit internal dan perbaikan berkelanjutan.</br>
                    </div>
                </div>

                <!-- Fokus 7 -->
                <div class="border border-primary rounded-lg overflow-hidden">
                    <button @click="openFocus = openFocus === 7 ? null : 7" class="w-full flex items-center justify-between p-4 hover:bg-blue-50 transition duration-150 bg-white">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            <span class="text-lg font-semibold text-text-dark text-left">
                                Meningkatkan Dampak Sosial dan Ekonomi melalui Pengabdian
                            </span>
                        </div>
                        <svg :class="openFocus === 7 ? 'rotate-180' : ''" class="w-5 h-5 text-primary flex-shrink-0 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div x-show="openFocus === 7" x-transition class="px-4 pb-4 bg-blue-50 border-t border-primary text-medium">
                        Mengimplementasikan solusi analitik untuk UMKM, pemerintah daerah, dan komunitas lokal dengan pendekatan terukur, beretika, dan berkelanjutan.
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <a href="../index.php" class="px-5 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<?php
// Memanggil Footer (<footer>, tag penutup)
include '../includes/footer.php';
?>