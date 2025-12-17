<?php
require_once __DIR__ . '/../../config/database.php';

class PerolehanHki
{
    public static function all()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT p.id AS id, p.tahun AS tahun, d.nama AS nama_dosen, p.judul_tema_hki AS judul_tema_hki, p.jenis AS jenis, p.nomor_id AS nomor_id FROM perolehan_hki p INNER JOIN dosen AS d ON p.dosen_id = d.id ORDER BY p.id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function allByDosen($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM perolehan_hki WHERE dosen_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM perolehan_hki WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dosen_id, $judul_tema_hki, $jenis, $tahun, $nomor_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO perolehan_hki (dosen_id,judul_tema_hki,jenis,tahun,nomor_id) VALUES (:dosen_id, :judul_tema_hki, :jenis, :tahun, :nomor_id)');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_tema_hki' => $judul_tema_hki, 'jenis' => $jenis, 'tahun' => $tahun, 'nomor_id' => $nomor_id]);
    }

    public static function update($id, $dosen_id, $judul_tema_hki, $jenis, $tahun, $nomor_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE perolehan_hki SET dosen_id= :dosen_id, judul_tema_hki= :judul_tema_hki, jenis= :jenis, tahun= :tahun, nomor_id= :nomor_id WHERE id= :id');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_tema_hki' => $judul_tema_hki, 'jenis' => $jenis, 'tahun' => $tahun, 'nomor_id' => $nomor_id, 'id' => $id]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM perolehan_hki WHERE id=?');
        $stmt->execute([$id]);
    }
}
