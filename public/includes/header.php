<?php
session_start();
$page_title = $page_title ?? "Laboratory of Business Analytics";

require_once __DIR__ . '/config.php';

$header_title = 'LABORATORIUM';
$header_subtitle = 'BUSINESS ANALYTICS';
$header_slogan = 'Transforming Data into Decisions';
$header_logo_url = BASE_URL . '/assets/Logo/logo2.png';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #124874;
            --color-secondary-light: #ECF2FB;
            --color-text-dark: #181818;
            --color-text-medium: #646464;
        }

        body {
            font-family: 'Manrope', 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .text-primary {
            color: var(--color-primary);
        }

        .bg-primary {
            background-color: var(--color-primary);
        }

        .border-primary {
            border-color: var(--color-primary);
        }

        .text-medium {
            color: var(--color-text-medium);
        }

        .outline-primary {
            outline-color: var(--color-primary);
        }

        .icon-box {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 4rem;
            height: 4rem;
            padding: 0.5rem;
            border-radius: 9999px;
        }
    </style>
</head>

<body class="bg-white">

    <div id="main-content" class="min-h-screen flex flex-col items-center">

        <header class="w-full border-b border-primary sticky top-0 bg-primary text-white z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <!-- LOGO -->
                    <img class="w-10 h-10 rounded-lg" src="<?php echo $header_logo_url; ?>" alt="LBA"
                        onerror="this.onerror=null; this.src='https://placehold.co/40x40/124874/FFFFFF?text=LBA';" />
                    <div class="flex flex-col">
                        <!-- TEKS HEADER -->
                        <span class="text-xs font-bold uppercase leading-tight text-white"><?php echo $header_title; ?></span>
                        <span class="text-sm font-bold uppercase leading-none text-white"><?php echo $header_subtitle; ?></span>
                        <span class="text-xs font-medium leading-none text-white mt"><?php echo $header_slogan; ?></span>
                    </div>
                </div>

                <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium">

                    <a href="<?php echo BASE_URL; ?>/index.php" class="text-white hover:text-blue-200 transition duration-150">
                        Beranda
                    </a>

                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" type="button" class="text-white hover:text-blue-200 transition duration-150 flex items-center focus:outline-none px-3 py-2">
                            Profil
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 10l5 5 5-5z" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20 origin-top-left">
                            <div class="py-1">
                                <a href="<?php echo BASE_URL; ?>/profile/VisiMisi.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Visi & Misi
                                </a>
                                <a href="<?php echo BASE_URL; ?>/profile/SO.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Struktur Organisasi
                                </a>
                                <a href="<?php echo BASE_URL; ?>/profile/FokusRiset.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Fokus Riset
                                </a>
                                <a href="<?php echo BASE_URL; ?>/profile/Dosen.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Dosen
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo BASE_URL; ?>/publikasi/Publikasi.php" class="text-white hover:text-blue-200 transition duration-150">
                        Publikasi
                    </a>

                    <a href="<?php echo BASE_URL; ?>/artikel/artikel.php" class="text-white hover:text-blue-200 transition duration-150">
                        Artikel
                    </a>

                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" type="button" class="text-white hover:text-blue-200 transition duration-150 flex items-center focus:outline-none px-3 py-2">
                            Aktifitas
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 10l5 5 5-5z" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20 origin-top-left">
                            <div class="py-1">
                                <a href="<?php echo BASE_URL; ?>/aktifitas/galerikegiatan.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Kegiatan
                                </a>
                                <a href="<?php echo BASE_URL; ?>/aktifitas/Fasilitas.php" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 hover:text-primary">
                                    Fasilitas
                                </a>
                            </div>
                        </div>
                    </div>

                </nav>

                <div class="flex items-center space-x-2">
                    <div class="hidden lg:block">
                        <a href="<?php echo BASE_URL; ?>/peminjaman/Peminjaman.php" class="inline-flex items-center px-6 py-2 bg-white text-primary text-sm font-bold rounded-full shadow-lg hover:bg-blue-100 transition duration-300">
                            Peminjaman
                        </a>
                    </div>

                    <div x-data="{ openMobileMenu: false }" class="lg:hidden relative">
                        <button @click="openMobileMenu = !openMobileMenu" class="p-2 rounded-md hover:bg-white/10 text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 8a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>

                        <div x-show="openMobileMenu" @click.outside="openMobileMenu=false" x-transition class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white text-black z-30 origin-top-right">
                            <a href="<?php echo BASE_URL; ?>/index.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                Beranda
                            </a>

                            <div x-data="{ profileOpen: false }">
                                <button @click="profileOpen = !profileOpen" class="flex items-center justify-between w-full px-4 py-2 text-sm hover:bg-gray-100">
                                    Profil
                                    <svg :class="profileOpen ? 'rotate-180' : ''" class="w-4 h-4 ml-2 transform transition duration-150" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7 10l5 5 5-5z" />
                                    </svg>
                                </button>
                                <div x-show="profileOpen" x-transition class="pl-4">
                                    <a href="<?php echo BASE_URL; ?>/profile/VisiMisi.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Visi & Misi</a>
                                    <a href="<?php echo BASE_URL; ?>/profile/SO.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Struktur Organisasi</a>
                                    <a href="<?php echo BASE_URL; ?>/profile/FokusRiset.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Fokus Riset</a>
                                    <a href="<?php echo BASE_URL; ?>/profile/Dosen.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Dosen</a>
                                </div>
                            </div>
                            <a href="<?php echo BASE_URL; ?>/publikasi/Publikasi.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                Publikasi
                            </a>
                            <a href="<?php echo BASE_URL; ?>/artikel/artikel.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                Artikel
                            </a>
                            <div x-data="{ resourcesOpen: false }">
                                <button @click="resourcesOpen = !resourcesOpen" class="flex items-center justify-between w-full px-4 py-2 text-sm hover:bg-gray-100">
                                    Aktifitas
                                    <svg :class="resourcesOpen ? 'rotate-180' : ''" class="w-4 h-4 ml-2 transform transition duration-150" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7 10l5 5 5-5z" />
                                    </svg>
                                </button>
                                <div x-show="resourcesOpen" x-transition class="pl-4">
                                    <a href="<?php echo BASE_URL; ?>/aktifitas/galerikegiatan.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        Kegiatan
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/aktifittas/Fasilitas.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        Fasilitas
                                    </a>
                                </div>
                            </div>

                            <div class="border-t border-gray-100"></div>
                            <a href="<?php echo BASE_URL; ?>/peminjaman/Peminjaman.php" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                Peminjaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>