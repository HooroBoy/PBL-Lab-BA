<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory of Business Analytics</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Use a modern font like Inter -->
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
            min-height: 100vh; /* Ensure the body covers the full viewport height */
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
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

        <!-- 1. Header/Navbar -->
        <header class="w-full border-b border-gray-200 sticky top-0 bg-white z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-2">
                    <img class="w-10 h-10 rounded-lg" src="https://placehold.co/40x40/124874/FFFFFF?text=LBA" alt="LBA Logo" />
                    <div class="flex flex-col">
                        <span class="text-xs font-bold uppercase leading-tight text-primary">Laboratorium</span>
                        <span class="text-sm font-bold uppercase leading-none text-primary">Business Analytics</span>
                        <span class="text-xs font-medium leading-none text-gray-500 mt-1">Transforming Data into Decisions</span>
                    </div>
                </div>

                <!-- Navigation Links (Hidden on mobile) -->
                <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium">
                    <a href="#" class="text-primary hover:text-blue-700 transition duration-150">Home</a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center">Profile <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg></a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150">Projects & Demo</a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center">Resources <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg></a>
                </nav>

                <!-- CTA Button -->
                <div class="flex items-center">
                    <button class="px-6 py-2 bg-primary text-white text-sm font-bold rounded-full shadow-lg hover:bg-blue-800 transition duration-300">
                        Booking
                    </button>
                </div>
            </div>
        </header>

        <!-- 2. Hero Section -->
        <section class="w-full bg-white pt-16 pb-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center lg:justify-between gap-12">
                
                <!-- Left Content -->
                <div class="w-full lg:w-1/2 flex flex-col space-y-8">
                    <div class="space-y-4">
                        <span class="inline-flex items-center px-4 py-2 bg-secondary-light text-primary text-xs font-semibold rounded-full border border-gray-200">
                            Business Analytics
                        </span>
                        <h1 class="text-5xl md:text-6xl font-extrabold text-text-dark leading-tight md:leading-snug">
                            Laboratory of Business Analytics
                        </h1>
                        <p class="text-lg text-medium leading-relaxed">
                            Sebagai bagian dari Jurusan Teknologi Informasi Politeknik Negeri Malang, Laboratorium Business Analytics berfokus pada pengembangan riset, pembelajaran, dan inovasi berbasis data. Kami membantu mahasiswa, dosen, dan mitra industri dalam mengoptimalkan pengambilan keputusan melalui analisis data yang cerdas dan tepat sasaran.
                        </p>
                    </div>
                    <button class="self-start px-8 py-4 text-sm font-bold bg-gray-50 text-text-dark rounded-full shadow-xl border-4 outline-primary hover:bg-gray-100 transition duration-300">
                        Learn More
                    </button>
                </div>

                <!-- Right Image -->
                <div class="w-full lg:w-5/12 flex justify-center">
                    <img class="w-full max-w-sm lg:max-w-lg h-auto rounded-xl shadow-2xl" 
                         src="https://placehold.co/510x600/124874/FFFFFF?text=Penguin+Mascot" 
                         alt="Penguin Mascot representing Data Analytics" 
                         onerror="this.onerror=null; this.src='https://placehold.co/510x600/124874/FFFFFF?text=Analytics+Lab';"
                    />
                </div>
            </div>
        </section>

        <!-- 3. Creating Solutions Section (Research Focus) -->
        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                <!-- Heading and Subtitle -->
                <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark lg:w-2/3">
                        Creating Solutions, <br/>Not Just Analysis
                    </h2>
                    <p class="text-lg text-medium lg:w-1/3">
                        The Business Analytics Laboratory is committed to moving beyond theoretical review. We focus on applying cutting-edge research to build tangible, data-driven solutions that solve complex business challenges. Our primary research areas include:
                    </p>
                </div>
                
                <!-- Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    
                    <!-- Card 1: Business Intelligence (Primary color) -->
                    <div class="p-6 bg-primary text-white rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-primary border-2 border-white">
                            <!-- Icon Placeholder (Chart/BI) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold">Business Intelligence</h3>
                        <p class="text-sm opacity-90 flex-grow">
                            We focus on transforming raw data into strategic assets. Our research explores advanced visualization and interactive dashboards to empower organizations with clear, actionable insights for better decision-making.
                        </p>
                        <a href="#" class="flex items-center text-sm font-semibold hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>

                    <!-- Card 2: Data Analytics & NLP -->
                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Database/Analysis) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Data Analytics & NLP</h3>
                        <p class="text-sm text-medium flex-grow">
                            Our work combines statistical modeling with machine learning and Natural Language Processing. We analyze complex, unstructured datasets to uncover hidden patterns, forecast trends, and extract valuable meaning from text.
                        </p>
                        <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>
                    
                    <!-- Card 3: Process Mining -->
                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Flow Chart/Process) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Process Mining</h3>
                        <p class="text-sm text-medium flex-grow">
                            By analyzing digital event logs, our research maps and evaluates real-world business operations. We focus on identifying bottlenecks, discovering inefficiencies, and optimizing workflows to enhance operational performance.
                        </p>
                        <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>

                    <!-- Card 4: Innovative Tools -->
                    <div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Toolbox/Development) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-text-dark">Innovative Tools</h3>
                        <p class="text-sm text-medium flex-grow">
                            We bridge the gap between theory and practice. This area focuses on developing novel prototypes and functional applications, turning our research in BI, analytics, and process mining into practical, usable tools that deliver real-world value.
                        </p>
                        <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline">
                            Learn More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Explore Our Work Section -->
        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center">
                    Explore Our Work
                </h2>
                
                <!-- Project Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Project 1 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="https://placehold.co/400x500/F0F0F0/646464?text=Dashboard+Mockup" 
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
                            <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Try the Demo 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Project 2 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="https://placehold.co/400x500/F0F0F0/646464?text=NLP+Analysis" 
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
                            <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Read More 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Project 3 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-80 object-cover rounded-xl shadow-lg" 
                            src="https://placehold.co/400x500/F0F0F0/646464?text=Process+Mining+Flow" 
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
                            <a href="#" class="flex items-center text-sm font-semibold text-primary hover:underline pt-4">
                                Read More 
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <button class="px-8 py-3 text-sm font-bold bg-gray-50 text-text-dark rounded-full border border-gray-300 hover:bg-gray-100 transition duration-300">
                    Explore More Articles
                </button>

            </div>
        </section>

        <!-- 5. Live Demo Feature Block -->
        <section class="w-full bg-white py-20 md:py-24">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center lg:justify-between gap-12">
                
                <!-- Right Content -->
                <div class="w-full lg:w-7/12 flex flex-col space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-bold text-text-dark leading-snug">
                            Live Demo: Interactive Analytics Prototype
                        </h2>
                        <p class="text-lg text-medium leading-relaxed">
                            We don't just research; we build solutions. Get hands-on with our interactive prototype and see how Business Intelligence and Data Analytics can transform raw data into strategic decisions. This demo is the tangible result of our research focus, giving you a real-time data analysis experience.
                        </p>
                    </div>
                    <button class="self-start px-8 py-3 text-sm font-bold bg-gray-50 text-text-dark rounded-full border border-gray-300 hover:bg-gray-100 transition duration-300">
                        Learn More
                    </button>
                </div>
                
                <!-- Left Image -->
                <div class="w-full lg:w-5/12 flex justify-center">
                    <div class="relative w-full max-w-sm lg:max-w-lg h-[400px] md:h-[600px] rounded-xl shadow-2xl bg-gray-700 bg-cover bg-center"
                        style="background-image: url('https://placehold.co/510x600/124874/FFFFFF?text=Interactive+Demo');">
                        <span class="absolute top-6 left-6 inline-block px-4 py-2 bg-white text-text-dark text-sm font-semibold rounded-full border border-white shadow-md">
                            <span class="inline-block w-2 h-2 bg-[#427AD3] rounded-full mr-2"></span>
                            Core Feature
                        </span>
                    </div>
                </div>
            </div>
        </section>


        <!-- 6. Our Lab in Action Section (Gallery) -->
        <section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <!-- Heading and Tabs -->
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark">
                        Our Lab in Action
                    </h2>
                    <div class="flex space-x-2 p-2 bg-white border border-gray-300 rounded-full">
                        <button class="px-8 py-2 bg-primary text-white text-sm font-bold rounded-full hover:bg-blue-800 transition duration-150">
                            Activities
                        </button>
                        <button class="px-8 py-2 text-medium text-sm font-medium rounded-full hover:bg-gray-50 transition duration-150">
                            Facility
                        </button>
                    </div>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Item 1 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/E0E0E0/646464?text=Workshop+1" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/E0E0E0/646464?text=Image+1';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/D0D0D0/646464?text=Seminar+2" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/D0D0D0/646464?text=Image+2';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/C0C0C0/646464?text=Team+Meeting+3" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/C0C0C0/646464?text=Image+3';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 4 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/B0B0B0/646464?text=Presentation+4" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/B0B0B0/646464?text=Image+4';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 5 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/A0A0A0/646464?text=Hackathon+5" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/A0A0A0/646464?text=Image+5';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 6 -->
                    <div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/909090/646464?text=Field+Trip+6" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/909090/646464?text=Image+6';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                </div>

                <button class="px-8 py-3 text-sm font-bold bg-gray-50 text-text-dark rounded-full border border-gray-300 hover:bg-gray-100 transition duration-300">
                    View Full Gallery
                </button>

            </div>
        </section>

        <!-- 7. Footer -->
        <footer class="w-full bg-primary py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white space-y-16">
                
                <!-- Top Section: Logo and Links -->
                <div class="flex flex-col lg:flex-row justify-between items-start space-y-10 lg:space-y-0">
                    
                    <!-- Brand and Contact Info -->
                    <div class="space-y-6 lg:w-1/4">
                        <div class="flex items-center space-x-2">
                            <img class="w-12 h-12 rounded-lg" src="https://placehold.co/48x48/F0F0F0/124874?text=LBA" alt="LBA Logo" />
                            <div class="flex flex-col">
                                <span class="text-base font-semibold uppercase leading-tight">Laboratorium</span>
                                <span class="text-xs font-light uppercase leading-none">Transforming data into decision</span>
                            </div>
                        </div>
                        <div class="text-sm space-y-2">
                            <h4 class="text-base font-semibold">Have a Project in Mind?</h4>
                            <p class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                <span>labbapolinema.com (Email Placeholder)</span>
                            </p>
                            <p class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.55.57.55 0 1 .45 1 1v3.5c0 .55-.45 1-1 1C10.74 21 3 13.26 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 .0.0.0.0.0.0 0 1.23.2 2.43.57 3.55.12.35.03.75-.24 1.02l-2.2 2.2z"/></svg>
                                <span>+62 xxxxxxxxxx (Phone Placeholder)</span>
                            </p>
                        </div>
                    </div>

                    <!-- Navigation Links Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 lg:gap-16 text-sm font-light">
                        
                        <!-- Col 1 -->
                        <div class="space-y-3">
                            <h4 class="text-base font-semibold mb-2">Home</h4>
                        </div>
                        
                        <!-- Col 2 -->
                        <div class="space-y-3">
                            <h4 class="text-base font-semibold mb-2">Profile</h4>
                            <ul class="space-y-2">
                                <li><a href="#" class="opacity-70 hover:opacity-100 transition duration-150">Vision & Mission</a></li>
                                <li><a href="#" class="opacity-70 hover:opacity-100 transition duration-150">Organizational Structure</a></li>
                                <li><a href="#" class="opacity-70 hover:opacity-100 transition duration-150">Research Focus</a></li>
                            </ul>
                        </div>
                        
                        <!-- Col 3 -->
                        <div class="space-y-3">
                            <h4 class="text-base font-semibold mb-2">Projects & Demo</h4>
                        </div>
                        
                        <!-- Col 4 -->
                        <div class="space-y-3">
                            <h4 class="text-base font-semibold mb-2">Resources</h4>
                            <ul class="space-y-2">
                                <li><a href="#" class="opacity-70 hover:opacity-100 transition duration-150">Lab Lecturer</a></li>
                                <li><a href="#" class="opacity-70 hover:opacity-100 transition duration-150">Activity Gallery</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Social Media -->
                <div class="flex flex-col md:flex-row justify-end items-center space-y-4 md:space-y-0 md:space-x-4 pt-8 border-t border-blue-800">
                    <div class="flex space-x-3">
                        <!-- Social Icon 1 -->
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-text-dark hover:bg-white transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.529-4 0v5.604h-3v-11h3v1.765c1.398-3.097 7-2.723 7 3.328v5.907z"/></svg>
                        </a>
                        <!-- Social Icon 2 -->
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-text-dark hover:bg-white transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22.46 6.03l-1.63 1.62c.07.3.11.6.11.9 0 4.54-3.47 8.24-7.85 8.24-1.5 0-2.89-.44-4.07-1.19l-1.39 1.39c1.6 1.09 3.5 1.74 5.51 1.74 6.55 0 11.87-5.32 11.87-11.87 0-1.42-.25-2.78-.71-4.02zM1.9 11.87c0 1.42.25 2.78.71 4.02l1.63-1.62c-.07-.3-.11-.6-.11-.9 0-4.54 3.47-8.24 7.85-8.24 1.5 0 2.89.44 4.07 1.19l1.39-1.39C14.7 4.02 12.8 3.37 10.79 3.37 4.24 3.37 0 8.69 0 11.87v0z"/></svg>
                        </a>
                        <!-- Social Icon 3 -->
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-text-dark hover:bg-white transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16.25v-8.5l6 4.25-6 4.25z"/></svg>
                        </a>
                        <!-- Social Icon 4 -->
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-text-dark hover:bg-white transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0 3c-3.86 0-7 3.14-7 7s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm0 10c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </footer>
    </div>
</body>
</html>