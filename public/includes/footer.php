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
                    <h4 class="text-base font-semibold mb-2">Artikel</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo BASE_URL; ?>/resource/Article.php" class="opacity-70 hover:opacity-100 transition duration-150">Artikel</a></li>

                    </ul>
                </div>

                <div class="space-y-3">
                    <h4 class="text-base font-semibold mb-2">Aktivitas</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo BASE_URL; ?>/resources/ActivityGallery.php" class="opacity-70 hover:opacity-100 transition duration-150">Galeri Kegiatan</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/resources/Fasilitas.php" class="opacity-70 hover:opacity-100 transition duration-150">Fasilitas</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4 pt-8 border-t border-blue-800">
            <p class="text-sm opacity-70">
                &copy; <?php echo date("Y"); ?> Laboratorium Business Analytics. Semua hak dilindungi.
            </p>
            <div class="flex space-x-3">
                <a href="#" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.529-4 0v5.604h-3v-11h3v1.765c1.398-3.097 7-2.723 7 3.328v5.907z" />
                    </svg>
                </a>
                <a href="#" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07c3.275.143 4.417 1.285 4.56 4.56.058 1.265.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.143 3.276-1.285 4.418-4.56 4.56-.058.003-.07.006-.07.006s-.003.006-.07.006h-.005c-1.266 0-1.646-.012-4.85-.07-3.275-.143-4.417-1.285-4.56-4.56-.058-1.265-.07-1.646-.07-4.85s.012-3.584.07-4.85c.143-3.276 1.285-4.418 4.56-4.56.058-.003.07-.006.07-.006s.003-.006.07-.006h.005zM12 3.864c-3.142 0-3.525.013-4.757.07c-2.715.12-3.81 1.215-3.93 3.93-.057 1.232-.07 1.615-.07 4.757s.013 3.525.07 4.757c.12 2.715 1.215 3.81 3.93 3.93.002.001.005.002.008.002h.005c1.232.057 1.615.07 4.757.07s3.525-.013 4.757-.07c2.715-.12 3.81-1.215 3.93-3.93.057-1.232.07-1.615.07-4.757s-.013-3.525-.07-4.757c-.12-2.715-1.215-3.81-3.93-3.93-.003-.001-.005-.002-.008-.002h-.005c-1.232-.057-1.615-.07-4.757-.07zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm5.75-9.15c0-.735-.596-1.332-1.33-1.332s-1.33.597-1.33 1.332.597 1.33 1.33 1.33 1.33-.597 1.33-1.33z" />
                    </svg>
                </a>
                <a href="#" class="w-10 h-10 flex items-center justify-center bg-transparent rounded-full text-white hover:bg-white/10 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.615 3.184c-3.665-.308-5.836-.452-9.615-.452s-5.951.144-9.615.452c-2.31.194-3.465 1.35-3.659 3.659-.308 3.665-.452 5.836-.452 9.615s.144 5.951.452 9.615c.194 2.31 1.35 3.465 3.659 3.659 3.665.308 5.836.452 9.615.452s5.951-.144 9.615-.452c2.31-.194 3.465-1.35 3.659-3.659.308-3.665.452-5.836.452-9.615s-.144-5.951-.452-9.615c-.194-2.31-1.35-3.465-3.659-3.659zM9.545 15.597v-7.194l6.09 3.597-6.09 3.597z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>

</div>

//notifikasi untuk peminjaman
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
        })
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
        })
    </script>
<?php  

$_SESSION['alerts']['type'] = null;
} ?>
</body>

</html>