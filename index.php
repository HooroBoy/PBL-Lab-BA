<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory of Business Analytics</title>
    <!-- Load Tailwind CSS --><script src="https://cdn.tailwindcss.com"></script>
    <!-- Use a modern font like Inter --><link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
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

        <!-- 1. Header/Navbar --><header class="w-full border-b border-gray-200 sticky top-0 bg-white z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <!-- Logo & Brand (Reverted to original text with new image) --><div class="flex items-center space-x-2">
                    <img class="w-10 h-10 rounded-lg" src="Images/Logo2.png" alt="LBA Logo" />
                    <div class="flex flex-col">
                        <span class="text-xs font-bold uppercase leading-tight text-primary">Laboratorium</span>
                        <span class="text-sm font-bold uppercase leading-none text-primary">Business Analytics</span>
                        <span class="text-xs font-medium leading-none text-gray-500 mt-1">Transforming Data into Decisions</span>
                    </div>
                </div>

                <!-- Navigation Links (Hidden on mobile) --><nav class="hidden lg:flex items-center space-x-8 text-sm font-medium">
                    <a href="#" class="text-primary hover:text-blue-700 transition duration-150">Home</a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center">Profile <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg></a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150">Projects & Demo</a>
                    <a href="#" class="text-text-dark hover:text-blue-700 transition duration-150 flex items-center">Resources <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg></a>
                </nav>

                <!-- CTA Button --><div class="flex items-center">
                    <button class="px-6 py-2 bg-primary text-white text-sm font-bold rounded-full shadow-lg hover:bg-blue-800 transition duration-300">
                        Booking
                    </button>
                </div>
            </div>
        </header>

        <!-- 2. Hero Section --><section class="w-full bg-white pt-16 pb-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center lg:justify-between gap-12">
                
                <!-- Left Content --><div class="w-full lg:w-1/2 flex flex-col space-y-8">
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

                <!-- Right Image --><div class="w-full lg:w-5/12 flex justify-center">
                    <img class="w-full max-w-sm lg:max-w-lg h-auto rounded-xl" 
                         src="Images/Penguin.png" 
                         alt="Business Analytics Lab Mascot" 
                         onerror="this.onerror=null; this.src='https://placehold.co/510x600/124874/FFFFFF?text=LBA+Mascot';"
                    />
                </div>
            </div>
        </section>

        <!-- 3. Creating Solutions Section (Research Focus) --><section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                <!-- Heading and Subtitle --><div class="flex flex-col lg:flex-row justify-between items-start gap-8">
                    <h2 class="text-4xl md:text-5xl font-bold text-text-dark lg:w-2/3">
                        Creating Solutions, <br/>Not Just Analysis
                    </h2>
                    <p class="text-lg text-medium lg:w-1/3">
                        The Business Analytics Laboratory is committed to moving beyond theoretical review. We focus on applying cutting-edge research to build tangible, data-driven solutions that solve complex business challenges. Our primary research areas include:
                    </p>
                </div>
                
                <!-- Feature Cards --><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    
                    <!-- Card 1: Business Intelligence (Primary color) --><div class="p-6 bg-primary text-white rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-primary border-2 border-white">
                            <!-- Icon Placeholder (Chart/BI) --><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
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

                    <!-- Card 2: Data Analytics & NLP --><div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Database/Analysis) --><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
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
                    
                    <!-- Card 3: Process Mining --><div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Flow Chart/Process) --><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
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

                    <!-- Card 4: Innovative Tools --><div class="p-6 bg-white shadow-lg border border-gray-300 rounded-xl flex flex-col space-y-6">
                        <div class="icon-box bg-gray-50 border border-gray-300">
                            <!-- Icon Placeholder (Toolbox/Development) --><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3a2.85 2.85 0 0 0-5.69 0H2v2h1.33A2.85 2.85 0 0 0 7 8.85h.01A2.85 2.85 0 0 0 12.69 8.85H22v-2h-1.33A2.85 2.85 0 0 0 17 3zM7 7.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM2 12h1.33A2.85 2.85 0 0 0 7 15.85h.01A2.85 2.85 0 0 0 12.69 15.85H22v-2h-1.33A2.85 2.85 0 0 0 17 12zM7 16.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm10 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
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

        <!-- 4. Explore Our Work Section --><section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <h2 class="text-4xl md:text-5xl font-bold text-text-dark text-center">
                    Explore Our Work
                </h2>
                
                <!-- Project Cards Grid --><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Project 1 --><div class="flex flex-col space-y-6">
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

                    <!-- Project 2 --><div class="flex flex-col space-y-6">
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

                    <!-- Project 3 --><div class="flex flex-col space-y-6">
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


        <!-- 6. Our Lab in Action Section (Gallery) --><section class="w-full bg-white py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 flex flex-col items-center">
                
                <!-- Heading and Tabs --><div class="w-full flex justify-between items-center">
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

                <!-- Gallery Grid --><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Item 1 --><div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/E0E0E0/646464?text=Workshop+1" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/E0E0E0/646464?text=Image+1';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 2 --><div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/D0D0D0/646464?text=Seminar+2" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/D0D0D0/646464?text=Image+2';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 3 --><div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/C0C0C0/646464?text=Team+Meeting+3" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/C0C0C0/646464?text=Image+3';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 4 --><div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/B0B0B0/646464?text=Presentation+4" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/B0B0B0/646464?text=Image+4';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 5 --><div class="flex flex-col space-y-6">
                        <img class="w-full h-64 object-cover rounded-xl shadow-md" 
                             src="https://placehold.co/400x400/A0A0A0/646464?text=Hackathon+5" 
                             alt="Lab Activity Image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/A0A0A0/646464?text=Image+5';"
                        />
                        <h3 class="text-xl font-bold text-text-dark">Text</h3>
                    </div>

                    <!-- Item 6 --><div class="flex flex-col space-y-6">
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

        <!-- 7. Footer --><footer class="w-full bg-primary py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                
                <!-- Top Section: Logo, Links, Social --><div class="flex flex-col lg:flex-row justify-between items-start space-y-10 lg:space-y-0 pb-12 border-b border-blue-700">
                    
                    <!-- Brand and Contact Info --><div class="space-y-6 lg:w-1/4">
                        <div class="flex items-center space-x-2">
                            <img class="w-10 h-10 rounded-lg" src="Images/Logo2.png" alt="LBA Logo" />
                            <div class="flex flex-col">
                                <span class="text-xs font-bold uppercase leading-tight">Laboratorium</span>
                                <span class="text-sm font-bold uppercase leading-none">Business Analytics</span>
                                <span class="text-xs font-medium leading-none text-blue-300 mt-1">Transforming Data into Decisions</span>
                            </div>
                        </div>
                        <div class="text-sm space-y-2 mt-4">
                            <p class="font-bold">Have a Project in Mind?</p>
                            <a href="mailto:lba@polinema.ac.id" class="flex items-center text-blue-300 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"