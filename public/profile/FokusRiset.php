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
                Menjelajahi cakrawala baru dalam teknologi dan analitik bisnis
            </p>
        </header>

        <!-- Research Activities Grid (4 columns on desktop) -->
        <!-- Grid diubah menjadi 4 kolom responsive -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Anomaly Detection -->
            <a class="group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
                        Anomaly Detection 
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Product Surveilance, Prediction Maintenance, Manufacturing Yield Optimization
                    </p>
                </div>
            </a>
            
            <!-- Card 2: Identity Theft -->
            <a class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Identity Theft
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Early detection of Identity theft, Identity theft scheme analysis, Multi-factor Authentication, vulnerability of personal data, and data governance framework.
                    </p>
                </div>
            </a>

            <!-- Card 3: Fraud Detection -->
            <a class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Fraud Detection
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Fake Information Detection for Text, Video, Audio , and Image.
                    </p>
                </div>
            </a>
            
            <!-- Card 4: Brand Image Analysis -->
            <a href="#tools" class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Brand Image Analysis
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Sentiment analysis, Competitor benchmarking, and Campaign effectiveness tracking.
                    </p>
                </div>
            </a>

            <!-- Card 5: Customer Analytics -->
            <a class="group block bg-white text-text-dark rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary hover:text-white">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold leading-snug group-hover:text-white transition duration-150">
                        Costumer Analytics
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Customer Relationship Management, Churn Analysis & prevention, Customer Satisfaction, Marketing cross-sell & up-sell. Promotional effects tracking and competitive response for pricing. And also Business process analysis for management and Supply chain management for pipeline tracking. 
                    </p>
                </div>
            </a>

            <!-- Card 6: Competitive Monitoring -->
            <a class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Competitive Monitoring
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Market trend forcasting and competitor strategy mapping.
                    </p>
                </div>
            </a>

            <!-- Card 7: New Product Developtment -->
            <a class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        New Product Development
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Idea generation & screening, and Market feasibility study.
                    </p>
                </div>
            </a>

            <!-- Card 8: Digital Marketing Analysis -->
            <a class="group block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-200 hover:bg-primary">
                <div class="p-6 space-y-6 flex flex-col h-full">
                    <h3 class="text-xl font-bold text-text-dark leading-snug group-hover:text-white transition duration-150">
                        Digital Marketing Analysis
                    </h3>
                    <p class="text-sm text-medium flex-grow group-hover:text-gray-200">
                        Pattern analysis and Content Analysis.
                    </p>
                </div>
            </a>
            
        </div>
        <!-- END: 8 Research Activities Grid -->
    </div>

    <div class="flex justify-center mt-8">
        <a href="../index.php" class="px-5 py-4 text-sm font-bold bg-primary text-white rounded-full border border-primary hover:bg-blue-800 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
    
</div>

<?php
// Memanggil Footer
require_once '../includes/footer.php';
?>