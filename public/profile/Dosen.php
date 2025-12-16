<?php
$page_title = 'Daftar Dosen Laboratory of Business Analytics';

require_once __DIR__ . '/../../app/models/Dosencontroller.php'; 

// Mengambil semua data dosen dari database
try {
    $dosenList = Dosen::all();
} catch (PDOException $e) {
    $dosenList = [];
}

// Fungsi helper untuk path gambar
function dosen_image_or_placeholder($path) {
    if (empty($path)) {
        return 'https://placehold.co/400x400/e2e8f0/1e293b?text=No+Image';
    }
    if (strpos($path, 'http') === 0) {
        return $path;
    }
    $clean_path = ltrim($path, '/'); 
    $base_url = '/PBL-Lab-BA/public/'; 
    $physical_path = $_SERVER['DOCUMENT_ROOT'] . $base_url . $clean_path;

    if (file_exists($physical_path)) {
        return $base_url . $clean_path;
    }
    return 'https://placehold.co/400x400/e2e8f0/1e293b?text=Not+Found'; 
}

if (defined('DOSEN_DATA_ONLY') && constant('DOSEN_DATA_ONLY')) {
  return;
}

include '../includes/header.php';
?>

<section class="w-full bg-white pt-12 pb-20">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    
    <nav class="text-sm font-medium text-gray-500 mb-4 inline-block" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="../index.php" class="text-primary hover:text-blue-700">Home</a>
                <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            </li>
            <li class="text-primary">Dosen</li>
        </ol>
    </nav>

    <h1 class="text-3xl font-extrabold text-text-dark mb-12">Tim Kami</h1>

    <?php if (!empty($dosenList)): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      
      <?php foreach ($dosenList as $d):
        // 1. Setup Data Dasar
        $dosen_id = $d['id'] ?? $d['nidn']; 
        $img = dosen_image_or_placeholder($d['foto'] ?? '');
        $link_detail = "LihatDosen.php?id=" . urlencode($dosen_id);
        
        // 2. Setup Link Sosmed
        // Saya pasang semua kemungkinan nama kolom biar pasti ketangkap
        $sinta    = $d['sinta_id'] ?? $d['sinta'] ?? $d['link_sinta'] ?? '#';
        $gscholar = $d['google_scholar_id'] ?? $d['google_scholar'] ?? $d['link_google_scholar'] ?? '#';
        $linkedin = $d['linkedin_id'] ?? $d['link_linkedin'] ?? $d['linkedin'] ?? $d['linkedin_url'] ?? '#';
      ?>

      <div class="group block bg-white rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_25px_rgba(0,0,0,0.15)] transition duration-300 relative overflow-hidden border border-gray-100">
        <div class="flex flex-col items-center text-center pb-6">
            
            <div class="w-full h-80 overflow-hidden mb-4 relative rounded-t-xl">
                
                <img src="<?php echo $img; ?>" 
                     alt="<?php echo htmlspecialchars($d['nama']); ?>" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110" 
                     onerror="this.onerror=null; this.src='<?php echo dosen_image_or_placeholder('default'); ?>';" />
                
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center z-20">
                    <a href="<?php echo $link_detail; ?>" class="translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 px-6 py-2 bg-blue-600 text-white font-bold rounded-full shadow-lg text-sm hover:bg-blue-700 flex items-center gap-2">
                        <span>View Profile</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <div class="px-4 w-full">
                
                <a href="<?php echo $link_detail; ?>">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 hover:text-blue-600 transition line-clamp-1" title="<?php echo htmlspecialchars($d['nama']); ?>">
                        <?php echo htmlspecialchars($d['nama']); ?>
                    </h3>
                </a>

                <div class="text-sm text-gray-500 font-medium mb-4">
                    <?php echo htmlspecialchars($d['program_studi'] ?? 'Dosen'); ?>
                </div>

                <hr class="border-gray-100 mb-1 w-1/2 mx-auto">

                <div class="flex justify-center items-center gap-3">
                    
                    <?php if($linkedin != '#' && $linkedin != ''): ?>
                        <a href="<?php echo $linkedin; ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-blue-700 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md border border-gray-100" title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    <?php endif; ?>

                    <?php if($gscholar != '#' && $gscholar != ''): ?>
                        <a href="<?php echo $gscholar; ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md border border-gray-100" title="Google Scholar">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 24a7 7 0 1 1 0-14 7 7 0 0 1 0 14zm0-24L0 9.5l4.838 3.94A8 8 0 0 1 12 9a8 8 0 0 1 7.162 4.44L24 9.5z"/></svg>
                        </a>
                    <?php endif; ?>

                    <?php if($sinta != '#' && $sinta != ''): ?>
                        <a href="<?php echo $sinta; ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md border border-gray-100" title="Sinta">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 14.5c-2.49 0-4.5-2.01-4.5-4.5S9.51 7.5 12 7.5s4.5 2.01 4.5 4.5-2.01 4.5-4.5 4.5z"/>
                                <text x="12" y="15.5" font-family="Arial" font-weight="bold" font-size="9" text-anchor="middle" fill="currentColor">S</text>
                            </svg>
                        </a>
                    <?php endif; ?>

                </div>
            </div>

        </div>
      </div>
      <?php endforeach; ?>
    </div>
    
    <?php else: ?>
    <p class="text-center text-lg text-medium py-10">Data dosen tidak ditemukan atau gagal dimuat dari database.</p>
    <?php endif; ?>
  </div>
</section>

<?php include '../includes/footer.php'; ?>