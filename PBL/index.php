<?php
// Set Judul Halaman
$page_title = "Laboratorium Business Analytics";
// Memanggil Header (Navbar, <head>, <body>, <div id="main-content")
include 'includes/header.php';
?>

<style>
/* --- Kustomisasi Fokus Riset Cards (Untuk index.php) --- */
/* Card hover: change card background to lab primary and make text readable */
/* Karena index.php memanggil header, kita bisa menaruh style di sini. */
.research-card.group:hover { background-color: #124874 !important; color: #fff !important; }
.research-card.group:hover h3, .research-card.group:hover p { color: #fff !important; }
.research-card.group .group-icon { transition: background-color .18s ease, color .18s ease, border-color .18s ease; }
.research-card.group:hover .group-icon { background-color: #fff !important; color: #124874 !important; border-color: transparent !important; }
</style>

        <section class="w-full bg-white pt-16 pb-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center lg:justify-between gap-12">
                <div class="w-full lg:w-1/2 flex flex-col space-y-8">
                    <div class="space-y-4">
                        <span class="inline-flex items-center px-4 py-2 bg-secondary-light text-primary text-xs font-semibold rounded-full border border-gray-500">
                            Business Analytics
                        </span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-text-dark leading-tight md:leading-snug">
                            Laboratorium Business Analytics
                        </h1>
                        <p class="text-lg text-medium leading-relaxed">
                            Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.
                        </p>
                    </div>
                    <a href="profile/VisiMisi.php" class="self-start px-8 py-4 text-sm font-bold bg-primary text-white rounded-full shadow-xl border-4 border-primary hover:bg-blue-800 transition duration-300 inline-block">
                        Pelajari Selengkapnya
                    </a>
                </div>

                <div class="w-full lg:w-5/12 flex justify-center">
                    <img class="w-full max-w-sm lg:max-w-lg h-auto rounded-xl" 
                         src="assets/Logo/Penguin.png" 
                         alt="Penguin Mascot representing Data Analytics" 
                         onerror="this.onerror=null; this.src='https://placehold.co/510x600/124874/FFFFFF?text=Analytics+Lab';"
                    />
                </div>
            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark md:w-2/3">
                        Fokus Riset
                    </h2>
                    <p class="text-lg text-medium md:w-1/3">
                        Laboratorium Business Analytics berkomitmen untuk bergerak melampaui tinjauan teoretis. Kami fokus menerapkan riset mutakhir untuk membangun solusi nyata berbasis data yang menyelesaikan tantangan bisnis yang kompleks. Area riset utama kami meliputi:
                    </p>
                </div>
                
                <!-- START: Fokus Riset Cards (Disesuaikan dengan FokusRiset.php) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Card 1: Business Intelligence -->
                    <a href="profile/FokusRiset.php#bi" class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            
                            <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
                                Intelijen Bisnis
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Kami fokus mengubah data mentah menjadi aset strategis. Riset kami mengeksplorasi teknik visualisasi canggih dan dasbor interaktif untuk memberdayakan organisasi dengan wawasan yang jelas dan dapat ditindaklanjuti.
                            </p>
                        </div>
                    </a>
                    
                    <!-- Card 2: Data Analytics & NLP -->
                    <a href="profile/FokusRiset.php#nlp" class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Analisis Data & NLP
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Pekerjaan kami menggabungkan pemodelan statistik dengan pembelajaran mesin dan Pemrosesan Bahasa Alami (NLP). Kami menganalisis dataset kompleks dan tak terstruktur untuk menemukan pola tersembunyi, meramalkan tren, dan mengekstrak makna dari teks.
                            </p>
                        </div>
                    </a>

                    <!-- Card 3: Process Mining (PM) -->
                    <a href="profile/FokusRiset.php#pm" class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Penambangan Proses
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Dengan menganalisis log peristiwa digital, riset kami memetakan dan mengevaluasi operasi bisnis nyata. Kami fokus mengidentifikasi hambatan, menemukan ketidakefisienan, dan mengoptimalkan alur kerja untuk meningkatkan kinerja operasional.
                            </p>
                        </div>
                    </a>
                    
                    <!-- Card 4: Innovative Tools -->
                    <a href="profile/FokusRiset.php#tools" class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Alat Inovatif
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Kami menjembatani jurang antara teori dan praktik. Area ini fokus pada pengembangan prototipe dan aplikasi fungsional, mengubah riset kami menjadi alat praktis yang memberikan nilai nyata.
                            </p>
                        </div>
                    </a>
                    
                </div>
                <!-- END: Fokus Riset Cards -->
                
                <!-- START: Explore Our Research Button (Centered) -->
                <div class="flex justify-center w-full mt-12">
                    <a href="profile/FokusRiset.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full shadow-lg hover:bg-blue-800 transition duration-300">
                        Jelajahi Riset Kami
                    </a>
                </div>
                <!-- END: Explore Our Research Button (Centered) -->
            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center">
                    Jelajahi Karya Kami
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-1-dashboard.jpg" 
                            alt="Sales Forecasting Dashboard Mockup" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+1';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Demo Langsung
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Dasbor Interaktif Peramalan Penjualan</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                Lihat alat BI kami beraksi. Demo interaktif ini menggunakan analisis deret waktu untuk meramalkan tren penjualan dan memvisualisasikan indikator kinerja utama.
                            </p>
                            <a href="projects-demos/prototypes/sales-demo" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Coba Demo 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-2-nlp.jpg" 
                            alt="Sentiment Analysis project illustration" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+2';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Proyek Analisis Data
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Analisis Sentimen Ulasan E-commerce</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                Analisis mendalam menggunakan NLP untuk memahami sentimen pelanggan. Proyek ini membantu mengidentifikasi faktor utama yang mempengaruhi kepuasan dan ketidakpuasan.
                            </p>
                            <a href="projects-demos/project-2.php" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Baca Selengkapnya 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-3-process-mining.jpg" 
                            alt="Hospital Workflow process diagram" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+3';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Skripsi Mahasiswa
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Mengoptimalkan Alur Kerja Rumah Sakit dengan Process Mining</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                Tesis ini menerapkan teknik process mining pada data administrasi pasien, berhasil mengidentifikasi dan merekomendasikan solusi untuk kemacetan sistem.
                            </p>
                            <a href="projects-demos/project-3.php" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Baca Selengkapnya 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="projects-demos/index.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                    Jelajahi Karya Lainnya
                </a>

            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center lg:justify-between gap-12">
                
                <div class="w-full lg:w-7/12 flex flex-col space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-bold text-text-dark leading-snug">
                            Artikel
                        </h2>
                        <p class="text-lg text-medium leading-relaxed">
                            Kami tidak hanya meneliti; kami membangun solusi. Cobalah prototipe interaktif kami dan lihat bagaimana Business Intelligence dan Analisis Data dapat mengubah data mentah menjadi keputusan strategis. Demo ini merupakan hasil nyata dari fokus riset kami, memberi Anda pengalaman analisis data waktu nyata.
                        </p>
                    </div>
                    <a href="resource/Article.php" class="self-start px-8 py-4 text-sm font-bold bg-primary text-white rounded-full shadow-xl border-4 border-primary hover:bg-blue-800 transition duration-300 inline-block">
                        Pelajari Artikel
                    </a>
                </div>
                
                <div class="w-full lg:w-5/12 flex justify-center">
                    <div class="relative w-full max-w-sm lg:max-w-lg h-[400px] md:h-[600px] rounded-xl shadow-2xl bg-gray-700 bg-cover bg-center"
                        style="background-image: url('assets/images/interactive-demo.jpg');"> <span class="absolute top-6 left-6 inline-block px-4 py-2 bg-white text-text-dark text-sm font-semibold rounded-full border border-white shadow-md">
                            <span class="inline-block w-2 h-2 bg-[#427AD3] rounded-full mr-2"></span>
                            Fitur Utama
                        </span>
                    </div>
                </div>
            </div>
        </section>


        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
                        Laboratorium Kami dalam Aksi
                    </h2>
                    <div x-data="{ active: 'activities' }" class="relative flex space-x-2 p-2 bg-white border border-gray-300 rounded-full">
                        <button @click="active = 'activities'" :class="active === 'activities' ? 'bg-primary text-white' : 'bg-transparent text-medium'" class="relative z-10 px-8 py-2 text-sm font-bold rounded-full transition duration-150">
                            Kegiatan
                        </button>
                        <button @click="active = 'facility'" :class="active === 'facility' ? 'bg-primary text-white' : 'bg-transparent text-medium'" class="relative z-10 px-8 py-2 text-sm font-medium rounded-full transition duration-150">
                            Fasilitas
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/workshop-1.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/E0E0E0/646464?text=Image+1';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Workshop Data Science</h3>
                    </div>
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/seminar-2.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/D0D0D0/646464?text=Image+2';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Seminar Riset Terbaru</h3>
                    </div>
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/team-meeting-3.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/C0C0C0/646464?text=Image+3';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Diskusi Proyek Akhir</h3>
                    </div>
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/presentation-4.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/B0B0B0/646464?text=Image+4';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Presentasi Hasil Riset</h3>
                    </div>
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/hackathon-5.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/A0A0A0/646464?text=Image+5';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Hackathon Data</h3>
                    </div>
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                            src="assets/images/galeri/field-trip-6.jpg" 
                            alt="Lab Activity Image"
                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/909090/646464?text=Image+6';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Kunjungan Industri</h3>
                    </div>
                </div>

                <a href="resource/ActivityGallery.php" class="px-8 py-3 text-sm font-bold bg-primary text-white rounded-full border border-blue hover:bg-blue-100 transition duration-300">
                    Lihat Galeri Lengkap
                </a>

            </div>
        </section>

        <?php
// Memanggil Footer (<footer>, tag penutup)
include 'includes/footer.php';
?>