<?php 
require_once '../config/database.php';

class Peminjaman{
    private $pdo;

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
    public static function create($nama, $no_induk, $tanggal_mulai,$tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan) {
        global $pdo;
        $sql = "INSERT INTO peminjaman (
                    nama_peminjam, 
                    no_induk, 
                    tanggal_mulai, 
                    tanggal_selesai, 
                    jam_mulai, 
                    jam_selesai, 
                    keperluan
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nama, 
            $no_induk, 
            $tanggal_mulai,  
            $tanggal_selesai,   
            $jam_mulai, 
            $jam_selesai, 
            $keperluan
        ]);
    }
  
    public static function delete($id){
        global $pdo;
        $sql = "DELETE FROM peminjaman WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
    public static function setStatus($id, $status){
        global $pdo;
        $sql = "UPDATE peminjaman SET status = ?,updated_at = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $id]);
    }
    
}

?>