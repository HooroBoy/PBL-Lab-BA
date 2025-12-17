<?php
$page_title = "Fokus Riset Laboratory of Business Analytics";

require_once '../includes/header.php';
require_once '../../app/models/Kategori.php';

$kategoriList = Kategori::all();
$limit = 8;
?>



<style>
    a.group:hover {
        background-color: #124874 !important;
        color: #fff !important;
    }

    a.group:hover h3,
    a.group:hover p,
    a.group:hover .card-learn {
        color: #fff !important;
    }

    a.group .group-icon {
        transition: background-color .18s ease, color .18s ease, border-color .18s ease;
    }

    a.group:hover .group-icon {
        background-color: #fff !important;
        color: #124874 !important;
        border-color: transparent !important;
    }
</style>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- Header Section -->
        <header class="text-center mb-12 space-y-3">
            <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="../index.php" class="text-primary hover:text-blue-700">Home</a>
                        <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li class="text-primary">Fokus Riset</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Fokus Riset
            </h1>
            <p class="text-lg text-medium">
                Menjelajahi cakrawala baru dalam teknologi dan analitik bisnis
            </p>
        </header>

        <!-- Research Activities Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <?php foreach ($kategoriList as $index => $kategori): ?>

                    <a class="group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white
                    <?= $index >= $limit ? 'hidden extra-item' : '' ?>"
                        href="#">
                        <div class="p-6 space-y-6 flex flex-col h-full">
                            <h3 class="text-xl font-bold leading-snug group-hover:text-white transition">
                                <?= htmlspecialchars($kategori['nama']); ?>
                            </h3>
                            <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                                <?= htmlspecialchars($kategori['deskripsi']); ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Load More Button -->
            <?php if (count($kategoriList) > $limit): ?>
                <div class="text-center mt-8">
                    <button id="viewMoreBtn"
                        class="px-6 py-3 bg-primary text-white font-semibold rounded-full hover:bg-blue-900 transition">
                        View More
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="flex justify-center mt-8">
            <a href="../index.php" class="px-5 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('viewMoreBtn');
            if (!btn) return;

            btn.addEventListener('click', function() {
                document.querySelectorAll('.extra-item')
                    .forEach(el => el.classList.remove('hidden'));

                btn.style.display = 'none';
            });
        });
    </script>


    <?php
    require_once '../includes/footer.php';
    ?>