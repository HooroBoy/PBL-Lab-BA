<?php 
require_once __DIR__ . '/../../config/database.php';


class Peminjaman{
    public static function getAll(){
        global $pdo;
        $sql = "SELECT * FROM peminjaman ORDER BY 
        CASE 
            WHEN status = 'menunggu' THEN 1
            WHEN status = 'diterima' THEN 2
            WHEN status = 'ditolak' THEN 3
        END, status ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function create($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan, $no_wa) {
        global $pdo;

        // Trim input minimal
        $nama = trim($nama);
        $no_induk = trim($no_induk);
        $keperluan = trim($keperluan);

        $sql = "INSERT INTO peminjaman (
                    nama_peminjam, 
                    no_induk, 
                    tanggal_mulai, 
                    tanggal_selesai, 
                    jam_mulai, 
                    jam_selesai, 
                    keperluan,
                    no_wa
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        try {
            return $stmt->execute([
                $nama, 
                $no_induk, 
                $tanggal_mulai,  
                $tanggal_selesai,   
                $jam_mulai, 
                $jam_selesai, 
                $keperluan,
                $no_wa
            ]);
        } catch (Exception $e) {
            // Optional: log $e->getMessage()
            return false;
        }
    }
  
    public static function delete($id){
        global $pdo;
        $sql = "DELETE FROM peminjaman WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public static function setStatus($id, $status, $alasan){
        global $pdo;
        $sql = "UPDATE peminjaman SET status = ?, alasan_penolakan = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $alasan, $id]);
    } 
}
?>
