<?php
require_once __DIR__ . '/../../config/database.php';

class Pengabdian
{
    public static function all()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT p.id AS id, p.tahun AS tahun, d.nama AS nama_dosen, p.judul_pengabdian AS judul_pengabdian, p.sumber_dana AS sumber_dana, p.jumlah_dana AS jumlah_dana FROM pengalaman_pengabdian p INNER JOIN dosen AS d ON p.dosen_id = d.id ORDER BY p.id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function allByDosen($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM pengalaman_pengabdian WHERE dosen_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM pengalaman_pengabdian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dosen_id, $judul_pengabdian, $sumber_dana, $tahun, $jumlah_dana)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO pengalaman_pengabdian (dosen_id,judul_pengabdian,sumber_dana,tahun,jumlah_dana) VALUES (:dosen_id, :judul_pengabdian, :sumber_dana, :tahun, :jumlah_dana)');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_pengabdian' => $judul_pengabdian, 'sumber_dana' => $sumber_dana, 'tahun' => $tahun, 'jumlah_dana' => $jumlah_dana]);
    }

    public static function update($id, $dosen_id, $judul_pengabdian, $sumber_dana, $tahun, $jumlah_dana)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE pengalaman_pengabdian SET dosen_id= :dosen_id, judul_pengabdian= :judul_pengabdian, sumber_dana= :sumber_dana, tahun= :tahun, jumlah_dana= :jumlah_dana WHERE id= :id');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_pengabdian' => $judul_pengabdian, 'sumber_dana' => $sumber_dana, 'tahun' => $tahun, 'jumlah_dana' => $jumlah_dana, 'id' => $id]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM pengalaman_pengabdian WHERE id=?');
        $stmt->execute([$id]);
    }
}
