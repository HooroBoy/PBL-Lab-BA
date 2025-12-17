<?php
require_once __DIR__ . '/../../config/database.php';

class Dosen {
    // Ambil semua data dosen
    public static function all() {
        global $pdo;
        // Kita urutkan berdasarkan nama, atau bisa berdasarkan urutan tertentu
        $stmt = $pdo->query("SELECT * FROM dosen ORDER BY nama ASC");
        return $stmt->fetchAll();
    }
}
?>