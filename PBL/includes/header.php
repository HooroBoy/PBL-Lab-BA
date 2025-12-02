<?php
$page_title = $page_title ?? "Laboratory of Business Analytics";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <style>
        /* Custom colors based on the design */
        :root {
            --color-primary: #124874; /* Biru Penguin */
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
        .text-primary { color: var(--color-primary); }
        .bg-primary { background-color: var(--color-primary); }
        .border-primary { border-color: var(--color-primary); }
        .text-medium { color: var(--color-text-medium); }
        .outline-primary { outline-color: var(--color-primary); }

        /* Custom styles for the intricate icons/shapes in the original design */
        .icon-box {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 4rem; /* 64px */
            height: 4rem; /* 64px */
            padding: 0.5rem;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-white">

    <div id="main-content" class="min-h-screen flex flex-col items-center">

        <header class="w-full border-b border-gray-200 sticky top-0 bg-white z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img class="w-10 h-10 rounded-lg" src="assets/images/lba-logo-placeholder.png" alt="LBA Logo" 
                         onerror="this.onerror=null; this.src='https://placehold.co/40x40/124874/FFFFFF?text=LBA';" />
                    <div class="flex flex-col">
                        <span class="text-xs font-bold uppercase leading-tight text-primary">Laboratorium</span>
                        <span class="text-sm font-bold uppercase leading-none text-primary">Business Analytics</span>
                        <span class="text-xs font-medium leading-none text-gray-500 mt-1">Transforming Data into Decisions</span>
                    </div>
                </div>

                <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium">
                    
                    <a href="../index.php" class="text-primary hover:text-blue-700 transition duration-150">Home</a>
                    
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" type="button" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center focus:outline-none px-3 py-2">
                            Profile 
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20 origin-top-left">
                            <div class="py-1">
                                <a href="profile/VisiMisi.php" class="block px-4 py-2 text-sm text-text-dark hover:bg-gray-100 hover:text-primary">
                                    Visi & Misi
                                    <a href="../profile/SO.php"></a>
                                    <a href="../profile/FokusRiset.php"></a>
                                </a>
                                <a href="profile/SO.php" class="block px-4 py-2 text-sm text-text-dark hover:bg-gray-100 hover:text-primary">
                                    Struktur Organisasi
                                    <a href="../profile/VisiMisi.php"></a>
                                    <a href="../profile/FokusRiset.php"></a>
                                </a>
                                <a href="profile/FokusRiset.php" class="block px-4 py-2 text-sm text-text-dark hover:bg-gray-100 hover:text-primary">
                                    Fokus Riset
                                    <a href="../profile/VisiMisi.php"></a>
                                    <a href="../profile/SO.php"></a>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="projects-demos/index.php" class="text-text-dark hover:text-blue-700 transition duration-150">Projects & Demo</a>
                    
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" type="button" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center focus:outline-none px-3 py-2">
                            Resources 
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transform transition duration-200" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20 origin-top-left">
                            <div class="py-1">
                                <a href="resources/activity-gallery.php" class="block px-4 py-2 text-sm text-text-dark hover:bg-gray-100 hover:text-primary">
                                    Activity Gallery
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </nav>

                <div class="flex items-center">
                    <button class="px-6 py-2 bg-primary text-white text-sm font-bold rounded-full shadow-lg hover:bg-blue-800 transition duration-300">
                        Booking
                    </button>
                </div>
            </div>
        </header>