<?php 
include_once '../model/Peminjaman.php';
class PeminjamanController{
    public static function insertJadwal($nama, $no_induk, $tanggal_mulai,$tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan){
        if(PeminjamanController::isSlotAvailable($tanggal_mulai,$tanggal_selesai, $jam_mulai, $jam_selesai)){
            Peminjaman::create($nama, $no_induk, $tanggal_mulai,$tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan);
        }
    }
    public static function isSlotAvailable($tgl_mulai, $tgl_selesai, $jam_mulai, $jam_selesai) {
        global $pdo;
    
        $inputStart = "$tgl_mulai $jam_mulai";
        $inputEnd   = "$tgl_selesai $jam_selesai";
        
        $sql = "SELECT COUNT(*) FROM peminjaman WHERE 
                status = 'diterima' AND
                (
                    (tanggal_mulai + jam_mulai) < ? AND 
                    (tanggal_selesai + jam_selesai) > ?
                )";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$inputEnd, $inputStart]);
        return $stmt->fetchColumn() == 0;
    }
}

?>