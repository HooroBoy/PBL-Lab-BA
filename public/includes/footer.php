<?php if (!defined('BASE_URL')) {
    require_once __DIR__ . 'config.php';
} ?>
<footer class="w-full bg-primary py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white space-y-16">

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-10 lg:space-y-0">

            <div class="space-y-6 lg:w-1/4">
                <!-- Partner logos (JTI & Polinema) -->
                <div class="flex items-center space-x-3">
                    <img class="h-14 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/LogoPolinema.png" alt="Logo Polinema" />
                    <img class="h-12 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/LogoJTI.png" alt="Logo JTI" />
                    <img class="h-14 w-auto" src="<?php echo BASE_URL; ?>../assets/Logo/Logo2.png" alt="Logo BA" />

                </div>
                <div class="text-sm space-y-2">
                    <h4 class="text-base font-semibold">Punya Proyek yang Ingin Dibahas?</h4>
                    <p class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span>labbapolinema.com (Contoh Email)</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.55.57.55 0 1 .45 1 1v3.5c0 .55-.45 1-1 1C10.74 21 3 13.26 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 .0.0.0.0.0.0 0 1.23.2 2.43.57 3.55.12.35.03.75-.24 1.02l-2.2 2.2z" />
                        </svg>
                        <span>+62 xxxxxxxxxx (Contoh Nomor)</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <!-- Map pin (white silhouette) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z" />
                        </svg>
                        <span>Lantai 8 Gedung Teknik Sipil Politeknik Negeri Malang</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 lg:gap-16 text-sm font-light">

                <div class="space-y-3">
                    <h4 class="text-base font-semibold mb-2">Beranda</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo BASE_URL; ?>../index.php" class="opacity-70 hover:opacity-100 transition duration-150">Beranda</a></li>

                    </ul>
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
                    <h4 class="text-base font-semibold mb-2">Publikasi</h4>
                </div>

                <div class="space-y-3">
                    <h4 class="text-base font-semibold mb-2">Artikel</h4>
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
            <p class="text-sm opacity-70">
                &copy; <?php echo date("Y"); ?> Laboratorium Business Analytics. Semua hak dilindungi.
            </p>
            <div class="flex space-x-3">
                        <a href="https://www.instagram.com/jtipolinema/" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200">
                             <img src="<?php echo BASE_URL; ?>../assets/Logo/Instagram.png" alt="Instagram Icon" class="w-5 h-5"
                                  onerror="this.onerror=null; this.src='https://placehold.co/20x20/FFFFFF/124874?text=IG';" />
                        </a>
                        <a href="https://www.youtube.com/@jtipolinema367" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200">
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
if ($_SESSION['alerts']['type'] == 'danger' && isset($_SESSION['alerts']['type'])) {
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
if ($_SESSION['alerts']['type'] == 'success' && isset($_SESSION['alerts']['type'])) {
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