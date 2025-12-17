<?php
// --- PERBAIKAN DI SINI ---
// Gunakan __DIR__ agar path menjadi absolut dan akurat
require_once __DIR__ . '/../../config/database.php'; 

class SiteSetting {

    public static function get() {
        global $pdo;
        // Pastikan variabel $pdo tersedia dari config
        if (!isset($pdo)) {
            die("Koneksi database (PDO) belum terinisialisasi.");
        }
        
        $stmt = $pdo->query("SELECT * FROM website_setting ORDER BY id DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data) {
        global $pdo;
        $sql = "UPDATE website_setting SET landing_badge=:landing_badge, landing_title=:landing_title, landing_description=:landing_description, landing_hero_image=:landing_hero_image, footer_box_title=:footer_box_title, footer_email=:footer_email, footer_phone=:footer_phone, footer_address=:footer_address, social_linkedin=:social_linkedin, social_instagram=:social_instagram, social_youtube=:social_youtube, footer_copyright_text=:footer_copyright_text, updated_at=NOW() WHERE id=:id";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':landing_badge' => $data['landing_badge'],
            ':landing_title' => $data['landing_title'],
            ':landing_description' => $data['landing_description'],
            ':landing_hero_image' => $data['landing_hero_image'],
            ':footer_box_title' => $data['footer_box_title'],
            ':footer_email' => $data['footer_email'],
            ':footer_phone' => $data['footer_phone'],
            ':footer_address' => $data['footer_address'],
            ':social_linkedin' => $data['social_linkedin'],
            ':social_instagram' => $data['social_instagram'],
            ':social_youtube' => $data['social_youtube'],
            ':footer_copyright_text' => $data['footer_copyright_text'],
            ':id' => $data['id']
        ]);
    }
} // <--- Jangan lupa tutup kurung kurawal class di akhir file
?>