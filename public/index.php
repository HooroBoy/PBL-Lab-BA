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
  background: rgba(0, 0, 0, 0.8);
}

.hero-carousel-content {
  position: relative;
  z-index: 10;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: white;
  padding: 2rem 3rem;
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

.hero-carousel-controls {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 0.5rem;
  z-index: 20;
}

.hero-carousel-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.hero-carousel-dot.active {
  background-color: rgba(255, 255, 255, 1);
}

.hero-carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 20;
  background-color: rgba(255, 255, 255, 0.2);
  hover:background-color = rgba(255, 255, 255, 0.4);
  border: none;
  color: white;
  font-size: 2rem;
  padding: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.hero-carousel-nav:hover {
  background-color: rgba(255, 255, 255, 0.4);
}

.hero-carousel-nav.prev {
  left: 1rem;
}

.hero-carousel-nav.next {
  right: 1rem;
}

/* Team carousel: show 1/2/3 cards responsively, hide native scrollbar */
#teamCarousel { overflow: hidden; }
.carousel-track { display: flex; gap: 2rem; padding: 1rem 2rem; align-items: stretch; }
.carousel-track > a { flex: 0 0 320px; max-width: 320px; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
.scrollbar-hide::-webkit-scrollbar { display: none; }

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
  <!-- Slide 1: Laboratorium Business Analytics (with Penguin) -->
  <div class="hero-carousel-slide active" style="background-image: url('assets/Logo/gedung.png'); background-color: #1a1a1a;">
    <div class="hero-carousel-content">
      <div class="hero-carousel-text">
        <span class="inline-flex items-center px-4 py-2 bg-secondary-light text-white text-xs font-semibold rounded-full border border-gray-300 mb-4">
          Business Analytics
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight md:leading-snug mb-4">
          Laboratorium Business Analytics
        </h1>
        <p class="text-base md:text-lg text-gray-100 leading-relaxed mb-4">
          Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.
        </p>
        <a href="profile/VisiMisi.php" class="inline-block px-8 py-4 text-sm font-bold bg-primary text-white rounded-full shadow-xl hover:bg-blue-800 transition duration-300">
          Pelajari Selengkapnya
        </a>
      </div>
      <div class="hero-carousel-pinguin">
        <img src="assets/Logo/Pinguin.png" alt="Pinguin Mascot" />
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
  dots.forEach(dot => dot.classList.remove('active'));
  
  slides[currentSlideIndex - 1].classList.add('active');
  dots[currentSlideIndex - 1].classList.add('active');
}

function resetAutoSlide() {
  if (autoSlideTimer) clearInterval(autoSlideTimer);
  autoSlideTimer = setInterval(() => {
    changeSlide(1);
  }, 5000);
}

// Auto-advance slides every 5 seconds
resetAutoSlide();

// Scroll down helper: scroll to the next section after hero
function scrollDown() {
    const hero = document.querySelector('.hero-carousel');
    if (!hero) return;
    const nextTop = hero.getBoundingClientRect().bottom + window.scrollY;
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

                <a href="aktivitas/artikel.php"
                  class="inline-block px-7 py-3 text-sm font-semibold bg-primary text-white rounded-full shadow-md hover:bg-blue-800 transition duration-300">
                  Pelajari Artikel
                </a>
              </div>

              <!-- KANAN: CARD ARTIKEL -->
              <div class="relative max-w-md mx-auto rounded-2xl bg-white shadow-xl overflow-hidden">

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
                  <a href="#"
                    class="inline-flex items-center gap-1 text-primary font-semibold hover:underline">
                    Baca Selengkapnya
                    <span></span>
                  </a>
                </div>

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

                <a href="resource/ActivityGallery.php" class="px-8 py-3 text-sm font-bold bg-primary text-white rounded-full border border-blue hover:bg-blue-800 transition duration-300">
                    Lihat Galeri Lengkap
                </a>

            </div>
        </section>

        <?php
// Memanggil Footer (<footer>, tag penutup)
include 'includes/footer.php';
?>