<?php
// Set Judul Halaman
$page_title = "Laboratory of Business Analytics";
// Memanggil Header (Navbar, <head>, <body>, <div id="main-content")
include 'includes/header.php';
?>

        <section class="w-full bg-white pt-16 pb-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center lg:justify-between gap-12">
                <div class="w-full lg:w-1/2 flex flex-col space-y-8">
                    <div class="space-y-4">
                        <span class="inline-flex items-center px-4 py-2 bg-secondary-light text-primary text-xs font-semibold rounded-full border border-gray-500">
                            Business Analytics
                        </span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-text-dark leading-tight md:leading-snug">
                            Laboratory of Business Analytics
                        </h1>
                        <p class="text-lg text-medium leading-relaxed">
                            Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.
                        </p>
                    </div>
                    <button class="self-start px-8 py-4 text-sm font-bold bg-primary text-white rounded-full shadow-xl border-4 border-primary hover:bg-blue-800 transition duration-300">
                        Learn More
                    </button>
                </div>

                <div class="w-full lg:w-5/12 flex justify-center">
                    <img class="w-full max-w-sm lg:max-w-lg h-auto rounded-xl" 
                         src="assets/Logo/Penguin.png" 
                         alt="Penguin Mascot representing Data Analytics" 
                         onerror="this.onerror=null; this.src='https://placehold.co/510x600/124874/FFFFFF?text=Analytics+Lab';"
                    />
                </div>
            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark lg:w-2/3">
                        Fokus Riset
                    </h2>
                    <p class="text-lg text-medium lg:w-1/3">
                        The Business Analytics Laboratory is committed to moving beyond theoretical review. We focus on applying cutting-edge research to build tangible, data-driven solutions that solve complex business challenges. Our primary research areas include:
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="p-6 bg-primary text-white rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-primary border-2 border-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold">Business Intelligence</h3>
                        <p class="text-sm opacity-90 flex-grow">
                            We focus on transforming raw data into strategic assets. Our research explores advanced visualization and interactive dashboards to empower organizations with clear, actionable insights for better decision-making.
                        </p>
                        <a href="profile/research-focus.php#bi" class="flex items-center text-sm font-semibold hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>

                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Data Analytics & NLP</h3>
                        <p class="text-sm text-medium flex-grow">
                            Our work combines statistical modeling with machine learning and Natural Language Processing. We analyze complex, unstructured datasets to uncover hidden patterns, forecast trends, and extract valuable meaning from text.
                        </p>
                        <a href="profile/research-focus.php#nlp" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>
                    
                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Process Mining</h3>
                        <p class="text-sm text-medium flex-grow">
                            By analyzing digital event logs, our research maps and evaluates real-world business operations. We focus on identifying bottlenecks, discovering inefficiencies, and optimizing workflows to enhance operational performance.
                        </p>
                        <a href="profile/research-focus.php#pm" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>

                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Innovative Tools</h3>
                        <p class="text-sm text-medium flex-grow">
                            We bridge the gap between theory and practice. This area focuses on developing novel prototypes and functional applications, turning our research in BI, analytics, and process mining into practical, usable tools that deliver real-world value.
                        </p>
                        <a href="projects-demos/index.php" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center">
                    Explore Our Work
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-1-dashboard.jpg" 
                            alt="Sales Forecasting Dashboard Mockup" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+1';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Live Demo
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Interactive Sales Forecasting Dashboard</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                See our BI tools in action. This interactive demo uses time-series analysis to forecast sales trends and visualize key performance indicators.
                            </p>
                            <a href="projects-demos/prototypes/sales-demo" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Try the Demo 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-2-nlp.jpg" 
                            alt="Sentiment Analysis project illustration" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+2';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Data Analytics Project
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Sentiment Analysis of E-commerce Reviews</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                A deep-dive analysis using NLP to understand customer sentiment. This project helped identify key drivers of satisfaction and dissatisfaction.
                            </p>
                            <a href="projects-demos/project-2.php" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Read More 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="assets/images/project-3-process-mining.jpg" 
                            alt="Hospital Workflow process diagram" 
                            onerror="this.onerror=null; this.src='https://placehold.co/400x500/F0F0F0/646464?text=Project+3';"
                        />
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 bg-gray-50 text-text-dark text-xs font-medium rounded-full border border-gray-200">
                                Student Thesis
                            </span>
                            <h3 class="text-xl font-bold text-text-dark">Optimizing Hospital Workflows with Process Mining</h3>
                            <p class="text-sm text-medium h-12 overflow-hidden">
                                This thesis applied process mining techniques to patient administration data, successfully identifying and recommending solutions for system bottlenecks.
                            </p>
                            <a href="projects-demos/project-3.php" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Read More 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="projects-demos/index.php" class="px-6 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
                    Explore More The Work
                </a>

            </div>
        </section>

        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center lg:justify-between gap-12">
                
                <div class="w-full lg:w-7/12 flex flex-col space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-bold text-text-dark leading-snug">
                            Article
                        </h2>
                        <p class="text-lg text-medium leading-relaxed">
                            We don't just research; we build solutions. Get hands-on with our interactive prototype and see how Business Intelligence and Data Analytics can transform raw data into strategic decisions. This demo is the tangible result of our research focus, giving you a real-time data analysis experience.
                        </p>
                    </div>
                    <a href="projects-demos/prototypes/index.php" class="self-start px-8 py-3 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-100 transition duration-300">
                        Learn Articles
                    </a>
                </div>
                
                <div class="w-full lg:w-5/12 flex justify-center">
                    <div class="relative w-full max-w-sm lg:max-w-lg h-[400px] md:h-[600px] rounded-xl shadow-2xl bg-gray-700 bg-cover bg-center"
                        style="background-image: url('assets/images/interactive-demo.jpg');"> <span class="absolute top-6 left-6 inline-block px-4 py-2 bg-white text-text-dark text-sm font-semibold rounded-full border border-white shadow-md">
                            <span class="inline-block w-2 h-2 bg-[#427AD3] rounded-full mr-2"></span>
                            Core Feature
                        </span>
                    </div>
                </div>
            </div>
        </section>


        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
                        Our Lab in Action
                    </h2>
                    <div x-data="{ active: 'activities' }" class="relative flex space-x-2 p-2 bg-white border border-gray-300 rounded-full">
                            <!-- Indicator (animated) -->
                            <div class="absolute inset-y-1 left-1 w-1/2 bg-primary rounded-full pointer-events-none transform transition-transform duration-150"
                                :class="{ 'translate-x-0': active === 'activities', 'translate-x-full': active === 'facility' }"></div>

                        <button @click="active = 'activities'" :class="active === 'activities' ? 'bg-primary text-white' : 'bg-transparent text-medium'" class="relative z-10 px-8 py-2 text-sm font-bold rounded-full transition duration-150">
                            Activities
                        </button>
                        <button @click="active = 'facility'" :class="active === 'facility' ? 'bg-primary text-white' : 'bg-transparent text-medium'" class="relative z-10 px-8 py-2 text-sm font-medium rounded-full transition duration-150">
                            Facility
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

                <a href="resources/activity-gallery.php" class="px-8 py-3 text-sm font-bold bg-primary text-white rounded-full border border-blue hover:bg-blue-100 transition duration-300">
                    View Full Gallery
                </a>

            </div>
        </section>

        <?php
// Memanggil Footer (<footer>, tag penutup)
include 'includes/footer.php';
?>