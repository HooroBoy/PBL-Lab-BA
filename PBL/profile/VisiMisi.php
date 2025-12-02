<?php
// Set Judul Halaman
$page_title = "Visi & Misi Lab Business Analytics";

// Tentukan path relatif ke folder 'includes'
// Karena file ini ada di 'profile/', kita harus mundur satu level (..)
include '../includes/header.php';
?>

<section class="w-full bg-white pt-16 pb-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center leading-snug">
            Visi & Misi Lab
        </h1>

        <div class="flex justify-center">
            <div class="w-full lg:w-4/5 p-6 md:p-10 border-4 border-primary rounded-xl shadow-lg space-y-4">
                <h2 class="text-3xl font-bold text-primary pb-2 border-b border-primary">
                    Visi
                </h2>
                <p class="text-lg text-medium leading-relaxed">
                    Menjadi laboratorium rujukan nasional sebagai inkubator solusi cerdas berbasis data, yang berfungsi sebagai mitra strategis industri untuk mengakselerasi transformasi bisnis dan pengambilan keputusan yang berdampak.
                </p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="w-full lg:w-4/5 p-6 md:p-10 border-4 border-primary rounded-xl shadow-lg space-y-4">
                <h2 class="text-3xl font-bold text-primary pb-2 border-b border-primary">
                    Misi
                </h2>
                <ul class="list-disc list-outside space-y-2 pl-5 text-lg text-medium leading-relaxed">
                    <li>Mengembangkan riset terapan</li>
                    <li>Mengintegrasikan berbagai disiplin ilmu</li>
                    <li>Membangun kemitraan strategis dengan industry</li>
                    <li>Mengembangkan talenta (dosen dan mahasiswa)</li>
                    <li>Menjalankan tata kelola laboratorium yang profesional, etis, dan berkelanjutan</li>
                </ul>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark text-center pt-10 leading-snug">
            Tujuan Laboratorium Business Analytics
        </h1>

        <div class="flex justify-center">
            <div class="w-full p-6 md:p-10 border-4 border-primary rounded-xl shadow-lg space-y-6">
                <p class="text-lg text-medium leading-relaxed">
                    Tujuan utama Laboratorium Business Analytics (Lab BA) adalah mentransformasi Lab menjadi pusat keunggulan (center of excellence) yang berfokus pada inovasi, pengembangan sumber daya manusia (SDM), dan kemitraan strategis untuk akselerasi bisnis.
                </p>
                
                <h3 class="text-xl font-bold text-text-dark pt-2">Daftar Tujuan Utama:</h3>
                <ol class="list-decimal list-outside space-y-4 pl-5 text-lg text-medium leading-relaxed">
                    <li>
                        Mencapai Pengakuan Nasional: Menjadi laboratorium unggulan dan rujukan nasional dalam pengembangan dan implementasi solusi cerdas berbasis data.
                    </li>
                    <li>
                        Menciptakan Solusi Inovatif: Berfungsi sebagai inkubator solusi cerdas yang menghasilkan prototipe, model, dan aplikasi analitik yang bernilai tinggi dan siap pakai.
                    </li>
                    <li>
                        Mendorong Riset Terapan: Melaksanakan dan mengembangkan riset terapan yang terintegrasi dari berbagai disiplin ilmu, memastikan hasil penelitian relevan dan dapat diterapkan langsung di dunia nyata.
                    </li>
                    <li>
                        Membangun Kemitraan Strategis: Membangun dan memelihara kemitraan strategis dengan industri untuk menyediakan layanan konsultasi, kolaborasi proyek, dan memfasilitasi transformasi bisnis mitra.
                    </li>
                    <li>
                        Mengembangkan Talenta SDM: Meningkatkan kualitas dan kompetensi dosen dan mahasiswa dalam bidang Business Analytics, sehingga menjadi lulusan unggul yang siap berkontribusi pada pengambilan keputusan berbasis data.
                    </li>
                    <li>
                        Memperkuat Tata Kelola: Menjamin operasional Lab melalui tata kelola yang profesional, etis, dan berkelanjutan, termasuk kepatuhan terhadap standar etika dan privasi data.
                    </li>
                </ol>
            </div>
        </div>
        
    </div>
</section>

<?php
// Memanggil Footer (<footer>, tag penutup)
include '../includes/footer.php';
?>