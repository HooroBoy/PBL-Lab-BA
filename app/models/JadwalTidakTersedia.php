<?php 
class JadwalTidakTersedia 
{
    public static function createBlockedDate($waktu, $keterangan, $admin_id) {
        global $pdo;
        
        $sql = "INSERT INTO jadwal_tidak_tersedia (waktu, keterangan, admin_id) 
                VALUES (?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$waktu, $keterangan, $admin_id]);
    }
}


?>