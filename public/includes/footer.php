<?php 
// Pastikan BASE_URL sudah didefinisikan (diperlukan untuk link)
if (!defined('BASE_URL')) {
    // Asumsi config.php berada di level yang sama dengan includes/
    // Path ini mungkin perlu disesuaikan tergantung lokasi file config.php
    require_once dirname(__DIR__) . '/config.php';
}

// --- BAGIAN BARU UNTUK MENGAMBIL DATA SETTING ---
// Asumsi: File SiteSetting.php ada di path: ../app/models/SiteSetting.php
require_once dirname(__DIR__, 2) . '/app/models/SiteSetting.php';

try {
    $site_settings = SiteSetting::get();
} catch (PDOException $e) {
    // Jika gagal mengambil dari DB, inisialisasi array kosong
    $site_settings = [];
}

// Tentukan teks dinamis, gunakan default jika data tidak ada
// KOTAK KONTAK
$footer_box_title = $site_settings['footer_box_title'] ?? 'Punya Proyek yang Ingin Dibahas?';
$footer_email = $site_settings['footer_email'] ?? 'labbapolinema.com (Contoh Email)';
$footer_phone = $site_settings['footer_phone'] ?? '+62 xxxxxxxxxx (Contoh Nomor)';
$footer_address = $site_settings['footer_address'] ?? 'Lantai 8 Gedung Teknik Sipil Politeknik Negeri Malang';

// COPYRIGHT
$footer_copyright_text = $site_settings['footer_copyright_text'] ?? 'Laboratorium Business Analytics. Semua hak dilindungi.';

// SOSIAL MEDIA
$social_linkedin = $site_settings['social_linkedin'] ?? '#';
$social_instagram = $site_settings['social_instagram'] ?? '#';
$social_youtube = $site_settings['social_youtube'] ?? '#';

// --- AKHIR BAGIAN BARU ---
?>
<footer class="w-full bg-primary py-20">
    <div class="max-w-7xl mx-auto px-8 sm:px-6 lg:px-8 text-white space-y-16">

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-10 lg:space-y-0">

            <div class="space-y-6 lg:w-1/4">
                <!-- Partner logos (JTI & Polinema) -->
                <div class="flex items-center space-x-3">
                    <!-- ASET LOGO STATIS (Tetap statis karena ini adalah aset fisik, bukan teks dinamis) -->
                    <img class="h-14 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/LogoPolinema.png" alt="Logo Polinema" />
                    <img class="h-12 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/LogoJTI.png" alt="Logo JTI" />
                    <img class="h-14 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/Logo2.png" alt="Logo BA" />
                </div>
                
                <div class="text-sm space-y-2">
                    <!-- JUDUL KOTAK DINAMIS -->
                    <h4 class="text-base font-semibold"><?php echo htmlspecialchars($footer_box_title); ?></h4>
                    
                    <!-- EMAIL DINAMIS -->
                    <p class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span><?php echo htmlspecialchars($footer_email); ?></span>
                    </p>
                    
                    <!-- TELEPON DINAMIS -->
                    <p class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.55.57.55 0 1 .45 1 1v3.5c0 .55-.45 1-1 1C10.74 21 3 13.26 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 .0.0.0.0.0.0 0 1.23.2 2.43.57 3.55.12.35.03.75-.24 1.02l-2.2 2.2z" />
                        </svg>
                        <span><?php echo htmlspecialchars($footer_phone); ?></span>
                    </p>
                    
                    <!-- ALAMAT DINAMIS -->
                    <p class="flex items-center space-x-2">
                        <!-- Map pin (white silhouette) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z" />
                        </svg>
                        <span><?php echo htmlspecialchars($footer_address); ?></span>
                    </p>
                </div>
            </div>

            <!-- Bagian Navigasi (Tetap Statis) -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-8 lg:gap-6 text-sm font-light">
                <!-- Navigasi Statis... -->
                <div class="space-y-3">
                    <a href="../index.php" class="text-base font-semibold mb-2 hover:text-primary transition duration-200">
                        <h4>Beranda</h4>
                    </a>
                </div>

                <div class="space-y-3">
                    <h4 class="text-base font-semibold mb-2">Profil</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo BASE_URL; ?>/profile/VisiMisi.php" class="opacity-70 hover:opacity-100 transition duration-150">Visi & Misi</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/profile/SO.php" class="opacity-70 hover:opacity-100 transition duration-150">Struktur Organisasi</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/profile/FokusRiset.php" class="opacity-70 hover:opacity-100 transition duration-150">Fokus Riset</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/profile/Dosen.php" class="opacity-70 hover:opacity-100 transition duration-150">Dosen</a></li>

                    </ul>
                </div>

                <div class="space-y-3">
                    <a href="publikasi/Publikasi.php" class="text-base font-semibold mb-2 hover:text-primary transition duration-200">
                        <h4>Publikasi</h4>
                    </a>
                </div>

                <div class="space-y-3">
                    <a href="artikel/artikel.php" class="text-base font-semibold mb-2 hover:text-primary transition duration-200">
                        <h4>Artikel</h4>
                    </a>
                </div>

                <div class="space-y-3">
                    <h4 class="text-base font-semibold mb-2">Galeri</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo BASE_URL; ?>/galeri/galerikegiatan.php" class="opacity-70 hover:opacity-100 transition duration-150">Kegiatan</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/galeri/fasilitas.php" class="opacity-70 hover:opacity-100 transition duration-150">Fasilitas</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4 pt-8 border-t border-white-800">
            <!-- COPYRIGHT DINAMIS -->
            <p class="text-sm opacity-70">
                &copy; <?php echo date("Y"); ?> <?php echo preg_replace('/^©?\s*\d{4}\s*/', '', htmlspecialchars($footer_copyright_text)); ?>
            </p>
            
            <div class="flex space-x-3">
                <!-- LINKEDIN DINAMIS -->
                <a href="<?php echo htmlspecialchars($social_linkedin); ?>" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200" target="_blank">
                     <img src="<?php echo BASE_URL; ?>../assets/Logo/linkedin.png" alt="Linkedin Icon" class="w-5 h-5"
                          onerror="this.onerror=null; this.src='https://placehold.co/20x20/FFFFFF/124874?text=LI';" />
                </a>
                
                <!-- INSTAGRAM DINAMIS -->
                <a href="<?php echo htmlspecialchars($social_instagram); ?>" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200" target="_blank">
                     <img src="<?php echo BASE_URL; ?>../assets/Logo/Instagram.png" alt="Instagram Icon" class="w-5 h-5"
                          onerror="this.onerror=null; this.src='https://placehold.co/20x20/FFFFFF/124874?text=IG';" />
                </a>
                
                <!-- YOUTUBE DINAMIS -->
                <a href="<?php echo htmlspecialchars($social_youtube); ?>" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200" target="_blank">
                     <img src="<?php echo BASE_URL; ?>../assets/Logo/Youtube.png" alt="Youtube Icon" class="w-5 h-5"
                          onerror="this.onerror=null; this.src='https://placehold.co/20x20/FFFFFF/124874?text=YT';" />
                </a>
            </div>
        </div>
    </div>
</footer>

</div>

<!-- notifikasi untuk peminjaman -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_SESSION['alerts']) && isset($_SESSION['alerts']['type']) && $_SESSION['alerts']['type'] == 'danger') {
?>
    <script>
        Swal.fire({
            title: 'Error!',
            text: '<?= $_SESSION['alerts']['msg']  ?>',
            icon: 'warning',
        }).then(() => {
        window.location.reload(); // auto refresh
    });
    </script>
<?php  
$_SESSION['alerts']['type'] = null;

} ?>
<?php
if (isset($_SESSION['alerts']) && isset($_SESSION['alerts']['type']) && $_SESSION['alerts']['type'] == 'success') {
?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= $_SESSION['alerts']['msg']  ?>',
            icon: 'success',
        }).then(() => {
        window.location.reload(); // auto refresh
    });
    </script>
<?php  

$_SESSION['alerts']['type'] = null;
} ?>
</body>

</html>