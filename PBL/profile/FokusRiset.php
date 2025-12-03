<?php
// Set Judul Halaman
$page_title = "Fokus Riset - Laboratory of Business Analytics";
// Memanggil Header (Header will include HTML setup and Navbar)
require_once '../includes/header.php';
// Note: We use require_once because the page cannot render without the header.
?>

<style>
/* Card hover: change card background to lab primary and make text readable */
a.group:hover { background-color: #124874 !important; color: #fff !important; }
a.group:hover h3, a.group:hover p, a.group:hover .card-learn { color: #fff !important; }
a.group .group-icon { transition: background-color .18s ease, color .18s ease, border-color .18s ease; }
a.group:hover .group-icon { background-color: #fff !important; color: #124874 !important; border-color: transparent !important; }
</style>

<div class="w-full bg-white pt-8 pb-20 md:pt-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Header Section -->
        <header class="text-center mb-12 space-y-3">
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-dark leading-tight">
                Fokus Riset
            </h1>
            <p class="text-lg text-medium">
                Exploring new frontiers in technology and business analytics
            </p>
        </header>

        <!-- Research Activities Grid (4 columns on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Business Intelligence (WHITE default -> BLUE Hover) -->
            <a href="#bi" class="group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <!-- Icon Placeholder -->
                    <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
                        Business Intelligence
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        We focus on transforming raw data into strategic assets. Our research explores advanced visualization and interactive dashboards to empower organizations with clear, actionable insights for better decision-making.
                    </p>
                    
                    <div class="text-sm font-semibold text-primary flex items-center pt-2 group-hover:text-white group-hover:underline">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </div>
                </div>
            </a>
            
            <!-- Card 2: Data Analytics & NLP (Light Theme -> Hover Blue) -->
            <a href="#nlp" class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <!-- Icon Placeholder -->
                    <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                    </div>

                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Data Analytics & NLP
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Our work combines statistical modelling with machine learning and Natural Language Processing. We analyze complex, unstructured datasets to uncover hidden patterns, forecast trends, and extract valuable meaning from text.
                    </p>

                    <div class="text-sm font-semibold text-primary flex items-center pt-2 group-hover:text-white group-hover:underline">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </div>
                </div>
            </a>

            <!-- Card 3: Process Mining (PM) (Light Theme -> Hover Blue) -->
            <a href="#pm" class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <!-- Icon Placeholder -->
                    <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
                    </div>

                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Process Mining
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        By analyzing digital event logs, our research maps and evaluates real-world business operations. We focus on identifying bottlenecks, discovering inefficiencies, and optimizing workflows to enhance operational performance.
                    </p>
                    
                    <div class="text-sm font-semibold text-primary flex items-center pt-2 group-hover:text-white group-hover:underline">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </div>
                </div>
            </a>
            
            <!-- Card 4: Innovative Tools (Light Theme -> Hover Blue) -->
            <a href="#tools" class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <!-- Icon Placeholder -->
                    <div class="w-12 h-12 p-3 rounded-full bg-gray-50 text-primary flex items-center justify-center mb-2 border border-gray-300 group-hover:bg-white group-hover:text-primary group-hover:border-white group-icon">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
                    </div>

                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Innovative Tools
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        We bridge the gap between theory and practice. This area focuses on developing novel prototypes and functional applications, turning our research in BI, analytics, and process mining into practical, usable tools that deliver real-world value.
                    </p>

                    <div class="text-sm font-semibold text-primary flex items-center pt-2 group-hover:text-white group-hover:underline">
                        Learn More 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-150" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </div>
                </div>
            </a>

                             </span>
            </a>

        </div>

    </div>
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>