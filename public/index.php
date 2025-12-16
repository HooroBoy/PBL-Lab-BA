<?php
// Set Judul Halaman
$page_title = "Laboratorium Business Analytics";

// --- Ambil Data Site Setting ---
require_once __DIR__ . '/../app/models/SiteSetting.php';
require_once __DIR__ . '/../app/models/Artikel.php';
require_once __DIR__ . '/../app/models/Galeri.php';
require_once __DIR__ . '/../app/models/Kategori.php';
require_once __DIR__ . '/../app/models/Dosen.php'; //

$kategoriList = array_slice(Kategori::all(), 0, 4);

try {
  $setting = SiteSetting::get();
  // Mengambil HANYA 1 artikel terbaru untuk TEASER homepage
  $latestArticle = Artikel::latest(1);
  $article = $latestArticle[0] ?? null;
  //mengambil data dosen
  $dosenList = Dosen::all();

  // --- DATA DINAMIS GALERI ---
  $recentActivities = Galeri::latest('activity', 6);
  $recentFacilities = Galeri::latest('facility', 6);
} catch (PDOException $e) {
  // Penanganan error database
  $setting = [];
  $article = null;
  $recentActivities = [];
  $recentFacilities = [];
  $dosenList = [];
}

$landing_badge = $setting['landing_badge'] ?? 'Business Analytics';
$landing_title = $setting['landing_title'] ?? 'Laboratorium Business Analytics';
$landing_description = $setting['landing_description'] ?? 'Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.';

$landing_hero_image_file = $setting['landing_hero_image'] ?? 'assets/Logo/gedung.png';
$hero_mascot_image_file = $setting['hero_mascot_image'] ?? 'assets/Logo/Pinguin.png';
$landing_button_link = $setting['landing_button_link'] ?? 'profile/VisiMisi.php';

include 'includes/header.php';
?>

<style>
  /* --- Kustomisasi Fokus Riset Cards --- */
  .research-card.group:hover {
    background-color: #124874 !important;
    color: #fff !important;
  }

  .research-card.group:hover h3,
  .research-card.group:hover p {
    color: #fff !important;
  }

  .research-card.group .group-icon {
    transition: background-color .18s ease, color .18s ease, border-color .18s ease;
  }

  .research-card.group:hover .group-icon {
    background-color: #fff !important;
    color: #124874 !important;
    border-color: transparent !important;
  }

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
    filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
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

  @keyframes float {

    0%,
    100% {
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

  .scroll-down-btn {
    position: absolute;
    left: 50%;
    bottom: 3.25rem;
    transform: translateX(-50%);
    width: 44px;
    height: 44px;
    border-radius: 9999px;
    border: 2px solid rgba(255, 255, 255, 0.18);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.35);
    backdrop-filter: blur(4px);
    cursor: pointer;
    z-index: 30;
    transition: transform .18s ease, background .18s ease, opacity .18s ease;
  }

  .scroll-down-btn:hover {
    transform: translateX(-50%) translateY(-4px);
    background: rgba(0, 0, 0, 0.5);
  }

  .scroll-down-btn svg {
    opacity: 0.95;
  }

  .scroll-down-btn.__bounce {
    animation: bounce 1.8s infinite;
  }

  @keyframes bounce {

    0%,
    100% {
      transform: translateY(0px);
    }

    50% {
      transform: translateY(-6px);
    }
  }

  /* --- CUSTOM TEAM CAROUSEL STYLES --- */
  .carousel-track {
    display: flex;
    gap: 1.5rem;
    /* Gap 6 */
    padding: 1rem 0;
    align-items: stretch;
  }

  .team-card {
    width: 16rem;
    flex-shrink: 0;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    background-color: white;
  }

  .team-card {
    width: 16rem;
    flex-shrink: 0;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    background-color: white;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .team-card .image-wrapper {
    background-color: #f3f4f6;
    height: 20rem; /* Increased height to make the frame taller */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
  }

  .team-card img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* ensure uniform cropping to fill taller frame */
    display: block;
  }

  @media (max-width: 640px) {
    .team-card { width: 14.5rem; }
    .team-card .image-wrapper { height: 16rem; }
  }

  /* --- CUSTOM GALLERY CARD STYLES --- */
  /* Style untuk kartu di bagian "Laboratorium Kami dalam Aksi" */
  .gallery-card {
    background-color: #f3f4f6;
    /* Warna latar belakang abu-abu muda seperti di gambar */
    border-radius: 0.75rem;
    overflow: hidden;
    padding-bottom: 1rem;
  }

  .gallery-card img {
    height: 18rem;
    width: 100%;
    object-fit: cover;
    border-radius: 0.75rem 0.75rem 0 0;
  }

  /* Style untuk teks di bawah gambar */
  .gallery-card h3 {
    padding: 0.5rem 1rem 0;
    /* Padding kecil untuk teks */
    text-align: center;
  }

  /* Memastikan card display flex-col dan center */
  .gallery-card-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 5v14M19 12l-7 7-7-7" />
    </svg>
  </button>
</section>

<script>
  let currentSlideIndex = 1;

  function scrollDown() {
    const hero = document.querySelector('.hero-carousel');
    if (!hero) return;
    const nextTop = hero.getBoundingClientRect().height + window.scrollY;
    window.scrollTo({
      top: nextTop,
      behavior: 'smooth'
    });
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

      <?php foreach ($kategoriList as $kategori): ?>
        <a class="research-card group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
          <div class="p-6 space-y-6 flex flex-col h-full">

            <!-- Icon -->
            <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
              </svg>
            </div>

            <!-- Nama kategori -->
            <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
              <?= htmlspecialchars($kategori['nama']); ?>
            </h3>

            <!-- Deskripsi kategori -->
            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
              <?= htmlspecialchars($kategori['deskripsi']); ?>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

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

    <div class="relative w-full overflow-hidden p-4 "> <button onclick="moveCarousel('prev')" 
              class="absolute left-0 top-1/2 z-20 transform -translate-y-1/2 bg-white border border-gray-200 text-primary p-3 rounded-full shadow-lg hover:bg-gray-50 focus:outline-none carousel-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>

      <button onclick="moveCarousel('next')" 
              class="absolute right-0 top-1/2 z-20 transform -translate-y-1/2 bg-white border border-gray-200 text-primary p-3 rounded-full shadow-lg hover:bg-gray-50 focus:outline-none carousel-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      <div id="carouselTrack" class="flex gap-6 w-full justify-center transition-transform duration-300 ease-in-out">
        <?php
        if(count($dosenList) >= 4){
          
          
          foreach ($dosenList as $member) {
              $dbFoto = $member['foto'] ?? '';
              // Logic Path Foto
              if (empty($dbFoto)) {
                  $fotoUrl = 'https://placehold.co/540x360/EFEFEF/9A9A9A?text=No+Image';
              } else {
                  $fotoUrl = (strpos($dbFoto, 'assets/') !== false) ? BASE_URL . '/' . $dbFoto : BASE_URL . '/assets/Dosen/' . $dbFoto;
              }
  
              echo '<div class="team-card flex-shrink-0 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100" style="width: 16rem;">';
              echo '  <div class="h-64 bg-gray-50 overflow-hidden relative">';
              echo '    <img src="' . htmlspecialchars($fotoUrl) . '" class="w-full h-full object-cover" loading="lazy" onerror="this.src=\'https://placehold.co/540x360/EFEFEF/9A9A9A?text=Error\'">';
              echo '  </div>';
              echo '  <div class="p-4 text-center">';
              echo '    <h4 class="text-base font-bold text-text-dark line-clamp-1">' . htmlspecialchars($member['nama']) . '</h4>';
              echo '    <p class="text-xs text-primary uppercase font-semibold mt-1">' . htmlspecialchars($member['program_studi'] ?? 'Dosen') . '</p>';
              echo '  </div>';
              echo '</div>';
          }
        }else{
          echo '<h3 class="text-center ">Tidak ada anggota tim yang tersedia.</h3>';
        }
        ?>
      </div>

    </div>

    <div class="flex justify-center mt-8">
      <a href="profile/dosen.php" class="px-8 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300 shadow-md carousel-button">
        Lihat Tim Lengkap
      </a>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    const $track = $('#carouselTrack');
    const $cards = $('.team-card');
    const $cButton = $('.carousel-button');
    const gap = 24; // Sesuai gap-6 tailwind (1.5rem = 24px)
    let isAnimating = false;
    const totalCards = $cards.length;
    if(totalCards == 0){
      $cButton.addClass('hidden');
    }

    // Hitung lebar kartu + gap
    function getMoveWidth() {
        const cardWidth = $('.team-card').first().outerWidth();
        return cardWidth + gap;
    }

    window.moveCarousel = function(direction) {
        if (isAnimating) return;
        isAnimating = true;

        const moveDist = getMoveWidth();

        if (direction === 'next') {
            // === LOGIKA NEXT ===
            // 1. Geser Track ke Kiri (Margin Minus)
            $track.animate({ marginLeft: `-${moveDist}px` }, 300, 'swing', function() {
                // 2. Setelah animasi selesai:
                // Ambil kartu PERTAMA, pindahkan ke PALING BELAKANG
                $track.find('.team-card').first().appendTo($track);
                
                // 3. Reset Margin ke 0 (Instan, user tidak sadar karena urutan kartu sudah berubah)
                $track.css('marginLeft', '0px');
                
                isAnimating = false;
            });

        } else {
            // === LOGIKA PREV ===
            // 1. Ambil kartu TERAKHIR, pindahkan ke PALING DEPAN (Instan)
            $track.find('.team-card').last().prependTo($track);
            
            // 2. Set Margin ke Minus dulu (agar kartu yg baru dipindah tidak langsung muncul, tapi sembunyi di kiri)
            $track.css('marginLeft', `-${moveDist}px`);
            
            // 3. Animate Margin ke 0 (Geser Masuk ke Kanan)
            $track.animate({ marginLeft: '0px' }, 300, 'swing', function() {
                isAnimating = false;
            });
        }
    };
});
</script>

<script>
  $(document).ready(function() {
    const $carousel = $('#teamCarousel');
    const $track = $('.carousel-track');
    let isAnimating = false;

    window.teamScroll = function(direction) {
      if (isAnimating) return;

      // --- 1. UKUR GEOMETRI KARTU DENGAN PRESISI ---
      const $cards = $track.find('.team-card');
      const totalCards = $cards.length;
      
      // Kita tahu data diduplikasi di PHP, jadi jumlah set asli = total / 2
      const realCardCount = totalCards / 2; 

      if (realCardCount <= 0) return;

      const $firstCard = $cards.first();
      // Ambil gap. Jika tidak terbaca, default ke 24px (1.5rem)
      const gap = parseFloat($track.css('gap')) || 24; 
      // Lebar satu kartu full (width + gap)
      const itemWidth = $firstCard.outerWidth() + gap;
      
      // INI KUNCINYA: Lebar presisi dari SATU SET data (Set 1)
      const singleSetWidth = itemWidth * realCardCount;

      // Posisi saat ini
      let currentScroll = $carousel.scrollLeft();

      // Mulai Animasi
      isAnimating = true;

      if (direction === 'right') {
        // --- LOGIKA KANAN ---

        // Cek: Apakah kita sudah melewati batas Set 1?
        // Menggunakan ">= singleSetWidth - 10" (minus 10px untuk toleransi desimal browser)
        if (currentScroll >= (singleSetWidth - 10)) {
           // SNAP BACK: Pindahkan mundur sejauh satu set width. 
           // Ini menempatkan kita di posisi visual yang PERSIS sama di Set 1.
           currentScroll = currentScroll - singleSetWidth;
           $carousel.scrollLeft(currentScroll);
        }

        // Animasi Maju
        $carousel.animate({
          scrollLeft: currentScroll + itemWidth
        }, 400, 'swing', function() {
          isAnimating = false;
        });

      } else {
        // --- LOGIKA KIRI ---

        // Cek: Apakah kita mau geser ke kiri TAPI ruang sisa kurang dari lebar kartu?
        // (Artinya kita ada di awal atau hampir awal)
        if (currentScroll < itemWidth) {
           // SNAP FORWARD: Pindahkan maju sejauh satu set width ke Set 2.
           // Posisi visual tidak berubah, tapi sekarang kita punya ruang di kiri.
           currentScroll = currentScroll + singleSetWidth;
           $carousel.scrollLeft(currentScroll);
        }

        // Animasi Mundur
        $carousel.animate({
          scrollLeft: currentScroll - itemWidth
        }, 400, 'swing', function() {
          isAnimating = false;
        });
      }
    };
  });
</script>

<section class="w-full bg-white py-20 md:py-24">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center mb-20">
      Artikel Terbaru Kami
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

      <!-- KIRI: TEKS (TANGGAL, JUDUL, DESKRIPSI, AUTHOR, BUTTON) -->
      <div class="space-y-6">
        <!-- TANGGAL -->
        <?php if ($article): ?>
          <div class="inline-block bg-blue-100 text-primary text-xs font-bold px-3 py-1 rounded-full mb-2">
            <?php echo date('d F Y', strtotime($article['tanggal'])); ?>
          </div>
        <?php endif; ?>

        <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
          <!-- JUDUL DINAMIS -->
          <?php echo $article ? htmlspecialchars($article['judul']) : 'Artikel Terbaru'; ?>
        </h2>

        <div class="text-lg text-gray-600 max-w-xl leading-relaxed">
          <?php if ($article): ?>
            <!-- ISI/RINGKASAN DINAMIS -->
            <?php echo substr(strip_tags($article['isi']), 0, 300) . (strlen(strip_tags($article['isi'])) > 300 ? '...' : '...'); ?>
          <?php else: ?>
            <p>Kami tidak hanya melakukan analisis data, tetapi menghadirkan solusi cerdas berbasis data yang berdampak nyata. Melalui artikel dan prototipe interaktif yang kami kembangkan.</p>
          <?php endif; ?>
        </div>

        <!-- Author -->
        <?php if ($article): ?>
          <div class="flex items-center gap-2 text-primary text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
            <span class="text-medium"><?php echo htmlspecialchars($article['nama']); ?></span>
          </div>
        <?php endif; ?>

        <a href="<?php echo $article ? htmlspecialchars(BASE_URL . '/artikel/artikel.php?id=' . $article['id']) : 'resources/Article.php'; ?>"
          class="inline-block px-7 py-3 text-sm font-semibold bg-primary text-white rounded-full shadow-md hover:bg-blue-800 transition duration-300">
          Selengkapnya
        </a>
      </div>

      <!-- GAMBAR THUMBNAIL  -->
      <div class="relative w-full flex justify-center h-full">
        <?php if ($article): ?>
          <a href="<?php echo $article ? htmlspecialchars(BASE_URL . '/artikel/detail.php?id=' . $article['id']) : 'resources/Article.php'; ?>" 
            class="block group w-full rounded-2xl shadow-xl overflow-hidden bg-gray-100 hover:shadow-2xl transition duration-300 border border-gray-200">

            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center z-20">
              <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-5 py-2 bg-white text-primary font-bold rounded-full shadow-lg text-sm border-2 border-primary">
                View Artikel
              </span>
            </div>

            <!-- Gambar Thumbnail Penuh -->
            <img class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
              src="<?php echo htmlspecialchars(BASE_URL . '/' . $article['thumbnail']); ?>"
              alt="<?php echo htmlspecialchars($article['judul']); ?>"
              style="min-height: 320px; max-height: 450px;" />
          </a>
        <?php else: ?>
          <div class="flex items-center justify-center p-8 border border-dashed rounded-xl h-80 w-full bg-gray-50 text-medium">
            Belum ada artikel yang tersedia.
          </div>
        <?php endif; ?>
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
    <!--     KEGIATAN LIST (DINAMIS)     -->
    <!-- ===================== -->
    <div x-show="active === 'activities'" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
      <?php
      if (!empty($recentActivities)):
        foreach ($recentActivities as $act):
      ?>
          <div class="gallery-card-wrapper">
            <a href="<?php echo htmlspecialchars(BASE_URL . '/detail/galerikegiatan.php'); ?>"
              class="block gallery-card w-full shadow-lg hover:shadow-xl transition duration-300">
              <!-- PERBAIKAN: Hapus path statis /assets/kegiatan/ -->
              <img src="<?php echo htmlspecialchars(BASE_URL . '/' . $act['gambar']); ?>"
                onerror="this.src='https://placehold.co/400x400/cccccc/646464?text=Image';"
                alt="<?php echo htmlspecialchars($act['judul']); ?>" />
              <h3 class="text-lg font-semibold text-text-dark pt-3 pb-1">
                <?php echo htmlspecialchars($act['judul']); ?>
              </h3>
            </a>
          </div>
      <?php
        endforeach;
      else:
        echo '<p class="col-span-3 text-center text-gray-500">Belum ada data kegiatan.</p>';
      endif;
      ?>

      <!-- TOMBOL -->
      <div class="col-span-1 md:col-span-2 lg:col-span-3 w-full flex justify-center mt-10">
        <a href="detail/galeriKegiatan.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
          Lihat Galeri Kegiatan
        </a>
      </div>
    </div>

    <!-- ===================== -->
    <!--     FASILITAS LIST (DINAMIS)   -->
    <!-- ===================== -->
    <div x-show="active === 'facility'" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" style="display: none;">
      <?php
      if (!empty($recentFacilities)):
        foreach ($recentFacilities as $fac):
      ?>
          <div class="gallery-card-wrapper">
            <a href="<?php echo htmlspecialchars(BASE_URL . '/detail/fasilitas.php'); ?>"
              class="block gallery-card w-full shadow-lg hover:shadow-xl transition duration-300">
              <!-- PERBAIKAN: Hapus path statis /assets/fasilitas/ -->
              <img src="<?php echo htmlspecialchars(BASE_URL . '/' . $fac['gambar']); ?>"
                onerror="this.src='https://placehold.co/400x400/aaaaaa/646464?text=Facility';"
                alt="<?php echo htmlspecialchars($fac['judul']); ?>" />
              <h3 class="text-lg font-semibold text-text-dark hover:text-primary pt-3 pb-1">
                <?php echo htmlspecialchars($fac['judul']); ?>
              </h3>
            </a>
          </div>
      <?php
        endforeach;
      else:
        echo '<p class="col-span-3 text-center text-gray-500">Belum ada data fasilitas.</p>';
      endif;
      ?>

      <!-- TOMBOL -->
      <div class="col-span-1 md:col-span-2 lg:col-span-3 w-full flex justify-center mt-10">
        <a href="detail/fasilitas.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
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