<?php
// Set Judul Halaman
$page_title = "Laboratorium Business Analytics";

// --- Ambil Data Site Setting ---
// Asumsi: File SiteSetting.php ada di path: ../app/models/SiteSetting.php
// Kita perlu mengimpor file model SiteSetting.php
// Saya akan menggunakan path relatif yang benar dari root project.
require_once __DIR__ . '/../app/models/SiteSetting.php'; 

try {
    $setting = SiteSetting::get();
} catch (PDOException $e) {
    // Set array kosong jika database gagal diakses
    // Anda mungkin perlu memastikan file database.php di-include di SiteSetting.php
    $setting = [];
}

// Gunakan data dari setting, berikan nilai default jika data tidak ada atau gagal dimuat
$landing_badge = $setting['landing_badge'] ?? 'Business Analytics';
$landing_title = $setting['landing_title'] ?? 'Laboratorium Business Analytics';
$landing_description = $setting['landing_description'] ?? 'Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.';

// Gambar Latar Belakang Hero (digunakan untuk style background)
// Kolom 'landing_hero_image' diasumsikan menyimpan path ke gambar latar.
$landing_hero_image_file = $setting['landing_hero_image'] ?? 'assets/Logo/gedung.png';

// Gambar Maskot Penguin: Saya asumsikan ada kolom 'hero_mascot_image' di DB.
// Jika kolom tidak ada, akan menggunakan nilai default statis.
$hero_mascot_image_file = $setting['hero_mascot_image'] ?? 'assets/Logo/Pinguin.png'; 

// Link Tombol (Asumsi kolom di DB: 'landing_button_link')
$landing_button_link = $setting['landing_button_link'] ?? 'profile/VisiMisi.php';

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

/* --- Hero Carousel Styles --- */
.hero-carousel {
  position: relative;
  width: 100%;
  overflow: hidden;
  background-color: #1a1a1a;
}

.hero-carousel-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 0.8s ease-in-out;
  background-size: cover;
  background-position: center;
}

.hero-carousel-slide.active {
  opacity: 1;
}

.hero-carousel-slide::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /* Mengurangi overlay gelap agar teks lebih jelas */
  background: rgba(0, 0, 0, 0.5); 
}

.hero-carousel-content {
  position: relative;
  z-index: 10;
  width: 100%;
  height: 100%;
  max-width: 1280px;
  margin-left: auto;
  margin-right: auto;
  padding: 4rem 1rem;
  min-height: 80vh;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: white;
  gap: 3rem;
}

.hero-carousel-text {
  max-width: 600px;
  animation: slideInLeft 0.8s ease-out forwards;
  flex: 1;
}

.hero-carousel-pinguin {
  display: none;
  flex-shrink: 0;
  animation: slideInRight 0.8s ease-out forwards, float 3s ease-in-out infinite 0.8s;
}

.hero-carousel-pinguin img {
  max-width: 580px;
  height: auto;
  width: 100%;
  filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Animasi pinguin */
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-12px);
  }
}

@media (min-width: 1024px) {
  .hero-carousel-pinguin {
    display: block;
  }
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Tambahkan dot/nav style jika dibutuhkan carousel multi-slide */

/* Scroll down button */
.scroll-down-btn {
    position: absolute;
    left: 50%;
    /* move button slightly higher to avoid overlapping sticky header */
    bottom: 3.25rem;
    transform: translateX(-50%);
    width: 44px;
    height: 44px;
    border-radius: 9999px;
    border: 2px solid rgba(255,255,255,0.18);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.35);
    backdrop-filter: blur(4px);
    cursor: pointer;
    z-index: 30;
    transition: transform .18s ease, background .18s ease, opacity .18s ease;
}
.scroll-down-btn:hover { transform: translateX(-50%) translateY(-4px); background: rgba(0,0,0,0.5); }
.scroll-down-btn svg { opacity: 0.95; }

.scroll-down-btn.__bounce { animation: bounce 1.8s infinite; }
@keyframes bounce { 0%,100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(-6px); } }
</style>

<!-- Hero Carousel Section -->
<section class="hero-carousel" style="min-height: 90vh;">
  <!-- Slide 1: Dinamis dari SiteSetting -->
  <div class="hero-carousel-slide active" 
       style="background-image: url('<?php echo htmlspecialchars(BASE_URL . '/' . $landing_hero_image_file); ?>'); background-color: #1a1a1a;">
    <div class="hero-carousel-content">
      <div class="hero-carousel-text">
        <span class="inline-flex items-center px-4 py-2 bg-secondary-light text-white text-xs font-semibold rounded-full border border-gray-300 mb-4">
          <!-- BADGE DINAMIS -->
          <?php echo htmlspecialchars($landing_badge); ?>
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight md:leading-snug mb-4">
          <!-- JUDUL DINAMIS -->
          <?php echo htmlspecialchars($landing_title); ?>
        </h1>
        <p class="text-base md:text-lg text-gray-100 leading-relaxed mb-4">
          <!-- DESKRIPSI DINAMIS -->
          <?php echo nl2br(htmlspecialchars($landing_description)); ?>
        </p>
        <a href="<?php echo htmlspecialchars(BASE_URL . '/' . $landing_button_link); ?>" class="inline-block px-8 py-4 text-sm font-bold bg-primary text-white rounded-full shadow-xl hover:bg-blue-800 transition duration-300">
          Pelajari Selengkapnya
        </a>
      </div>
      <div class="hero-carousel-pinguin">
        <!-- LOGO PENGUIN DINAMIS -->
        <img src="<?php echo htmlspecialchars(BASE_URL . '/' . $hero_mascot_image_file); ?>" alt="Pinguin Mascot"
            onerror="this.onerror=null; this.src='<?php echo BASE_URL; ?>/assets/Logo/Pinguin.png';" />
      </div>
    </div>
  </div>
    <!-- Scroll down button -->
    <button aria-label="Scroll down" class="scroll-down-btn __bounce" onclick="scrollDown()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M19 12l-7 7-7-7"/></svg>
    </button>
</section>

<script>
let currentSlideIndex = 1;
let autoSlideTimer = null;

function changeSlide(n) {
  showSlide(currentSlideIndex += n);
  resetAutoSlide();
}

function currentSlide(n) {
  showSlide(currentSlideIndex = n);
  resetAutoSlide();
}

function showSlide(n) {
  let slides = document.querySelectorAll('.hero-carousel-slide');
  let dots = document.querySelectorAll('.hero-carousel-dot');
  
  if (n > slides.length) { currentSlideIndex = 1; }
  if (n < 1) { currentSlideIndex = slides.length; }
  
  slides.forEach(slide => slide.classList.remove('active'));
  // dots.forEach(dot => dot.classList.remove('active')); // Uncomment if multiple slides
  
  slides[currentSlideIndex - 1].classList.add('active');
  // dots[currentSlideIndex - 1].classList.add('active'); // Uncomment if multiple slides
}

function resetAutoSlide() {
  if (autoSlideTimer) clearInterval(autoSlideTimer);
  // autoSlideTimer = setInterval(() => { changeSlide(1); }, 5000); // Dinonaktifkan karena hanya 1 slide
}

// Initial state, show first slide
showSlide(currentSlideIndex);

// Scroll down helper: scroll to the next section after hero
function scrollDown() {
    const hero = document.querySelector('.hero-carousel');
    if (!hero) return;
    const nextTop = hero.getBoundingClientRect().height + window.scrollY; // Menggunakan tinggi hero untuk scroll
    window.scrollTo({ top: nextTop, behavior: 'smooth' });
}
</script>


        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 flex flex-col items-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-darktext-center">
                        Fokus Riset
                    </h2>
                    <p class="text-lg text-medium md:text-center max-w-3xl">
                        Laboratorium Business Analytics berkomitmen untuk bergerak melampaui tinjauan teoretis. Kami fokus menerapkan riset mutakhir untuk membangun solusi nyata berbasis data yang menyelesaikan tantangan bisnis yang kompleks. Area riset utama kami meliputi:
                    </p>
                </div>
                
                <!-- START: Fokus Riset Cards (sesuaikan dengan FokusRiset.php) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Card 1: Business Intelligence -->
                    <a class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            
                            <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
                                Intelijen Proses Bisnis & Keunggulan Operasional
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Mengoptimalkan proses bisnis internal (manufaktur, logistik, layanan) melalui process mining, peramalan, dan analisis operasional.
                            </p>
                        </div>
                    </a>
                    
                    <!-- Card 2: Data Analytics & NLP -->
                    <a class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Intelijen Pelanggan & Analitik Pemasaran
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Memahami Pelanggan untuk meningkatkan strategi pemasaran dan penjualan.
                            </p>
                        </div>
                    </a>

                    <!-- Card 3: Process Mining (PM) -->
                    <a class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Analitik Produk Digital & Platform
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Menganalisis data dari produk digital (aplikasi, website, IoT) untuk inovasi.
                            </p>
                        </div>
                    </a>
                    
                    <!-- Card 4: Innovative Tools -->
                    <a class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <!-- Icon Placeholder -->
                            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
                            </div>

                            <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                                Analitik Teks & NLP Terapan
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                Mengembangkan solusi cerdas dari data tidak terstruktur seperti teks.
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
            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 flex flex-col items-center">
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center">
                    Tim Kami
                </h2>
                
                <!-- Team carousel: 9 cards -->
                <div class="relative w-full">
                    <!-- Left / Right controls -->
                    <button aria-label="Prev" onclick="teamScroll('left')" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-20 bg-white border rounded-full p-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="currentColor"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                    </button>
                    <button aria-label="Next" onclick="teamScroll('right')" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-20 bg-white border rounded-full p-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="currentColor"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                    </button>

                    <div id="teamCarousel" class="py-6 scrollbar-hide" style="scroll-behavior:smooth;">
                        <div class="carousel-track" role="list">
                                <!-- 9 team cards -->
                                <?php
                                    $team = [
                                        ['name'=>'Dr. Rakhmat Arianto, S.ST., M.Kom.','title'=>'Kepala Lab','img'=>'assets/Dosen/Rakhmat-Arianto.jpg'],
                                        ['name'=>'Rokhimatul Wakhidah, S.Pd., M.T.','title'=>'Peneliti','img'=>'assets/Dosen/Rokhimatul-Wakhidah.jpg'],
                                        ['name'=>'Ir. Rudy Ariyanto, S.T., M.Cs.','title'=>'Peneliti','img'=>'assets/Dosen/Rudi-Ariyanto.jpg'],
                                        ['name'=>'Ahmadi Yuli Ananta, ST., M.M.','title'=>'Peneliti','img'=>'assets/Dosen/ahmadi-putih.jpg'],
                                        ['name'=>'Candra Bella Vista, S.Kom., MT.','title'=>'Peneliti','img'=>'assets/Dosen/Candra-Bella-Vista.jpg'],
                                        ['name'=>'Endah Septa Sintiya, S.Pd., M.Kom','title'=>'Peneliti','img'=>'assets/Dosen/Endah-Septa-Sintiya.jpg'],
                                        ['name'=>'Dhebys Suryani, S.Kom., MT','title'=>'Peneliti','img'=>'assets/Dosen/Dhebys-Suryani.jpg'],
                                        ['name'=>'Farid Angga Pribadi, S.Kom.,M.Kom.','title'=>'Peneliti','img'=>'assets/Dosen/Farid-Angga-Pribadi.jpg'],
                                        ['name'=>'Hendra Pradibta, S.E., M.Sc.','title'=>'Peneliti','img'=>'assets/Dosen/Hendra-Pradibta.jpg']
                                    ];
                                    foreach($team as $i => $member) {
                                        echo '<div class="w-60 flex-shrink-0 bg-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between">';
                                        echo '<div class="h-70 bg-gray-100 flex items-center justify-center">';
                                        echo '<img src="'.htmlspecialchars($member['img']).'" alt="'.htmlspecialchars($member['name']).'" class="w-full h-full object-cover" onerror="this.onerror=null; this.src=\'https://placehold.co/540x360/EFEFEF/9A9A9A?text=Team\'">';
                                        echo '</div>';
                                        echo '<div class="p-6 text-center">';
                                        echo '<h4 class="text-lg font-semibold text-text-dark mb-1">'.htmlspecialchars($member['name']).'</h4>';
                                        echo '<p class="text-sm text-primary font-medium mb-4">'.htmlspecialchars($member['title']).'</p>';
                                        echo '<div class="flex items-center justify-center gap-4">';
                                        echo '</div>';
                                        echo '</div></div>'; // Ditutup dengan </div>
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-8">
                        <a href="profile/dosen.php" class="px-8 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                            Lihat Tim Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <script>
        (function(){
            var carousel = document.getElementById('teamCarousel');
            var track = carousel ? carousel.querySelector('.carousel-track') : null;
            var autoplayInterval = 2000; // ms
            var cardWidth = 272; // fallback
            var timer = null;

            function updateCardWidth(){
                if(!track) return;
                var firstCard = track.querySelector('div'); // Diubah dari 'a' ke 'div'
                if(!firstCard) return;
                var gap = parseFloat(getComputedStyle(track).gap) || 24;
                cardWidth = Math.round(firstCard.getBoundingClientRect().width + gap);
            }

            function startAuto(){
                stopAuto();
                updateCardWidth();
                timer = setInterval(function(){
                    if(!carousel) return;
                    // when reaching end, go back to start
                    if(carousel.scrollLeft + carousel.clientWidth >= track.scrollWidth - 10){
                        carousel.scrollTo({left:0, behavior:'smooth'});
                    } else {
                        carousel.scrollBy({left: cardWidth, behavior:'smooth'});
                    }
                }, autoplayInterval);
            }

            function stopAuto(){ if(timer) { clearInterval(timer); timer=null; } }

            window.teamScroll = function(dir){
                stopAuto();
                updateCardWidth();
                if(!carousel) return;
                var amount = dir === 'left' ? -cardWidth : cardWidth;
                carousel.scrollBy({left: amount, behavior: 'smooth'});
                // restart autoplay after interaction
                setTimeout(startAuto, 2000);
            }

            if(carousel && track){
                // ensure track width fits its content and allow scroll calculations
                carousel.addEventListener('mouseenter', stopAuto);
                carousel.addEventListener('mouseleave', function(){ setTimeout(startAuto, 300); });
                // recalc sizes on resize
                window.addEventListener('resize', updateCardWidth);
                // initial measurements and start
                updateCardWidth();
                startAuto();
            }
        })();
        </script>

        <section class="w-full bg-white py-20 md:py-24">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
              
              <!-- KIRI: TEKS -->
              <div class="space-y-6">
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
                  Artikel
                </h2>

                <p class="text-lg text-gray-600 max-w-xl leading-relaxed">
                  Kami tidak hanya melakukan analisis data, tetapi menghadirkan 
                  solusi cerdas berbasis data yang berdampak nyata.
                  Melalui artikel dan prototipe interaktif yang kami kembangkan,
                  <span class="font-bold">Laboratorium Business Analytics</span> menunjukkan bagaimana 
                  <em>Business Intelligence</em> dan <em>Business Analytics</em> diterapkan secara 
                  <em>end-to-end</em>—mulai dari data mentah, pemodelan analitik, hingga rekomendasi keputusan strategis.
                </p>

                <a href="artikel/artikel.php"
                  class="inline-block px-7 py-3 text-sm font-semibold bg-primary text-white rounded-full shadow-md hover:bg-blue-800 transition duration-300">
                  Pelajari Artikel
                </a>
              </div>

              <!-- KANAN: SLIDER ARTIKEL -->
              <div class="relative max-w-md mx-auto">

                <!-- TOMBOL KIRI -->
                <button onclick="slideLeft()"
                  class="absolute -left-12 top-1/2 -translate-y-1/2 z-10
                        bg-blue shadow-md rounded-full w-10 h-10
                        flex items-center justify-center hover:bg-blue-100">
                  &#8249;
                </button>

                <!-- TOMBOL KANAN -->
                <button onclick="slideRight()"
                  class="absolute -right-12 top-1/2 -translate-y-1/2 z-10
                        bg-white shadow-md rounded-full w-10 h-10
                        flex items-center justify-center hover:bg-blue-100">
                  &#8250;
                </button>

                <!-- CONTAINER SLIDER -->
                <div id="artikelSlider"
                    class="flex overflow-x-auto scroll-smooth no-scrollbar">

                  <!-- === CARD ARTIKEL (KODE ANDA) === -->
                  <div class="min-w-full relative rounded-2xl bg-white shadow-xl overflow-hidden">

                    <!-- Badge Fitur -->
                    <span class="absolute -top-4 left-6 bg-white text-primary text-sm font-semibold px-4 py-1 rounded-full shadow">
                      Fitur Utama
                    </span>

                    <!-- Header Card -->
                    <div class="relative bg-blue-50 h-44 flex items-center justify-center">

                      <!-- Tanggal -->
                      <span class="absolute top-4 right-4 bg-primary text-white text-sm font-semibold px-4 py-1 rounded-full shadow">
                        25 November 2025
                      </span>

                      <!-- Kategori -->
                      <h3 class="text-xl font-semibold text-primary text-center px-6">
                        Artikel AI di Bidang Pendidikan
                      </h3>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-4">
                      <h4 class="text-2xl font-bold text-gray-900">
                        AI di Bidang Pendidikan
                      </h4>

                      <p class="text-gray-600 leading-relaxed">
                        Eksplorasi penggunaan kecerdasan buatan dalam pembelajaran
                        yang dipersonalisasi dan adaptif.
                      </p>

                      <!-- Author -->
                      <div class="flex items-center gap-2 text-primary text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Dr. Bima Sakti
                      </div>

                      <!-- Link -->
                      <a href="#" class="inline-flex items-center gap-1 text-primary font-semibold hover:underline">
                        Baca Selengkapnya
                      </a>
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </section>


        <section class="w-full bg-white py-20 md:py-24">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center"
              x-data="{ active: 'activities' }">

              <!-- JUDUL + TOGGLE BUTTON -->
              <div class="w-full flex justify-between items-center">
                  <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
                      Laboratorium Kami dalam Aksi
                  </h2>

                  <div class="relative flex space-x-2 p-2 bg-white border border-gray-300 rounded-full">
                      <button
                          @click="active = 'activities'"
                          :class="active === 'activities'
                              ? 'bg-primary text-white'
                              : 'bg-transparent text-medium'"
                          class="relative z-10 px-8 py-2 text-sm font-bold rounded-full transition duration-150">
                          Kegiatan
                      </button>

                      <button
                          @click="active = 'facility'"
                          :class="active === 'facility'
                              ? 'bg-primary text-white'
                              : 'bg-transparent text-medium'"
                          class="relative z-10 px-8 py-2 text-sm font-bold rounded-full transition duration-150">
                          Fasilitas
                      </button>
                  </div>
              </div>

              <!-- ===================== -->
              <!--     KEGIATAN LIST     -->
              <!-- ===================== -->
              <div
                  x-show="active === 'activities'"
                  x-transition
                  class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                  <!-- ITEM 1–6 (KEGIATAN) -->
                  <template x-for="(item, index) in [
                      {img:'workshop-1.jpg', title:'Workshop Data Science'},
                      {img:'seminar-2.jpg', title:'Seminar Riset Terbaru'},
                      {img:'team-meeting-3.jpg', title:'Diskusi Proyek Akhir'},
                      {img:'presentation-4.jpg', title:'Presentasi Hasil Riset'},
                      {img:'hackathon-5.jpg', title:'Hackathon Data'},
                      {img:'field-trip-6.jpg', title:'Kunjungan Industri'}
                  ]">
                      <div class="flex flex-col space-y-6">
                          <img class="w-full h-64 object-cover rounded-xl shadow-md"
                              :src="'assets/images/galeri/' + item.img"
                              onerror="this.src='https://placehold.co/400x400/cccccc/646464?text=Image';" />
                          <h3 class="text-xl font-bold text-text-dark" x-text="item.title"></h3>
                      </div>
                  </template>

                  <!-- TOMBOL -->
                  <div class="col-span-3 w-full flex justify-center mt-10">
                    <a href="galeri/galeriKegiatan.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                      Lihat Galeri Kegiatan
                    </a>
                  </div>
              </div>

              <!-- ===================== -->
              <!--     FASILITAS LIST    -->
              <!-- ===================== -->
              <div
                  x-show="active === 'facility'"
                  x-transition
                  class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                  <!-- ITEM FASILITAS -->
                  <template x-for="(item, index) in [
                      {img:'lab-ai.jpg', title:'Laboratorium AI'},
                      {img:'lab-iot.jpg', title:'Lab IoT & Embedded'},
                      {img:'lab-network.jpg', title:'Lab Jaringan Komputer'},
                      {img:'lab-robotic.jpg', title:'Lab Robotika'},
                      {img:'lab-multimedia.jpg', title:'Lab Multimedia'},
                      {img:'lab-cloud.jpg', title:'Lab Komputasi Awan'}
                  ]">
                      <div class="flex flex-col space-y-6">
                          <img class="w-full h-64 object-cover rounded-xl shadow-md"
                              :src="'assets/images/fasilitas/' + item.img"
                              onerror="this.src='https://placehold.co/400x400/aaaaaa/646464?text=Facility';" />
                          <h3 class="text-xl font-bold text-text-dark" x-text="item.title"></h3>
                      </div>
                  </template>

                  <!-- TOMBOL -->
                  <div class="col-span-3 w-full flex justify-center mt-10">
                    <a href="galeri/fasilitas.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                      Lihat Galeri Fasilitas
                    </a>
                  </div>
              </div>
          </div>
      </section>

        <?php
// Memanggil Footer (<footer>, tag penutup)
include 'includes/footer.php';
?>